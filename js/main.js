"use strict";
console.log("Hello, I'm connected to the world via JunkTrade");

(function( $ ) {

    //Function to animate slider captions 
    function doAnimations( elems ) {
        //Cache the animationend event in a variable
        var animEndEv = 'webkitAnimationEnd animationend';
        
        elems.each(function () {
            var $this = $(this),
                $animationType = $this.data('animation');
            $this.addClass($animationType).one(animEndEv, function () {
                $this.removeClass($animationType);
            });
        });
    }
    
    //Variables on page load 
    var $myCarousel = $('#carousel-example-generic'),
        $firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");
        
    //Initialize carousel 
    $myCarousel.carousel();
    
    //Animate captions in first slide on page load 
    doAnimations($firstAnimatingElems);
    
    //Pause carousel  
    $myCarousel.carousel('pause');
    
    
    //Other slides to be animated on carousel slide event 
    $myCarousel.on('slide.bs.carousel', function (e) {
        var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
        doAnimations($animatingElems);
    });  
    
})(jQuery);

//*************************************************************NEW


//-------------------------------------------------------------------------------------------------------------
// Functions to be invoked when the page DOM is ready for JavaScript code to execute
// These functions are the ones to get the requests, decisions and chat notifications
// Since the navbar is present on each page
$(document).ready(function(){
    console.log("All Elements in the Page was successfully loaded, we can begin our application logic");
    getUserRequests();
    getDecisions();
    newMessagesNotification();
    $('[data-toggle="tooltip"]').tooltip(); 
    
});  
//------------------------------------------------------------------------------------------------------------
// Long polling functionality for the requests, decisions and chat notifications
setInterval(function(){
    queryUserRequests();
    queryDecisions();
    queryNewMessages();
},2500);

var currNotifcations = [], currDecisions = [], currNewMessages =[], currNewMessagesNotification=[];
// Polls for new item requests
function queryUserRequests(){
    $.get("../index.php/requests", function(res){
        if(JSON.stringify(res) !== JSON.stringify(currNotifcations)){
            console.log("Request change");
            //toastr["info"]("New/Cancelled/Decision", "Request");
            if(res.length < currNotifcations.length){
                toastr["warning"]("Cancelled/Denied", "Request");
            }
            else{
                toastr["info"]("New/Decision", "Request");
            }
            toastr.options = {
              "closeButton": false,
              "debug": false,
              "newestOnTop": false,
              "progressBar": false,
              "positionClass": "toast-bottom-left",
              "preventDuplicates": false,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            };
            currNotifcations = res;
            notifications(res);
        }
    }, "json");  
}

// Polls for new decisions of item requests
function queryDecisions(){
    $.get("../index.php/decisions", function(res){
        if(JSON.stringify(res) !== JSON.stringify(currDecisions)){
            console.log("New Item Decision");
            toastr["info"]("Accepted/Denied/Read", "Decision")
            toastr.options = {
              "closeButton": false,
              "debug": false,
              "newestOnTop": false,
              "progressBar": false,
              "positionClass": "toast-bottom-left",
              "preventDuplicates": false,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            };
            currDecisions = res;
            decisions(res);
        }
    }, "json");  
}

// Polls for new/unread chat messages
function queryNewMessages(){
    $.get("../index.php/newmessagesnotification", function(messages){
        if(JSON.stringify(messages) !== JSON.stringify(currNewMessagesNotification)){
            toastr["info"]("New/Read", "Chat Message")
            toastr.options = {
              "closeButton": false,
              "debug": false,
              "newestOnTop": false,
              "progressBar": false,
              "positionClass": "toast-bottom-left",
              "preventDuplicates": false,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            };
            currNewMessagesNotification = messages;
            processNewMessagesNotification(messages);
        }
    },"json");
}
//--------------------------------------------------------------------------------------------------------------------
// Registration functionality to capture and make a post request with the information entered in the registration form
// If the user forgets to enter information in a field and tries to submit then him/her is greeted with an error message
// And the corresponding input field/s will be highlighted to show the user where the missing information is required 
function register(){
    var username = $("#username").val();
    var firstname = $("#firstname").val();
    var lastname = $("#lastname").val();
    var email = $("#email").val();
    var telephone = $("#telephone").val();
    var password = $("#password").val();
    var retypedpassword = $("#retypedpassword").val();
    var securityQuestion = $("#securityquestion").val();
    var securityAnswer = $("#securityanswer").val();
    var retypedSecurityAnswer = $("#retypedanswer").val();
    
    if(username == "" || firstname ==""||lastname == ""||email ==""||telephone ==""||password ==""||securityQuestion==""||securityAnswer==""||retypedpassword == ""||retypedSecurityAnswer ==""){
        swal({ 
            title: "Form Incomplete!",
            text: "Please fill in empty fields",
            type: "error",
            timer: 1000,
            showConfirmButton: false
        });
    }
    else{
        var regUser = {
            "username" : username,
            "firstname" : firstname,
            "lastname" : lastname,
            "email" : email,
            "telephone" : telephone,
            "password" : password,
            "securityquestion" : securityQuestion,
            "securityanswer" : securityAnswer
        };
        //console.log(regUser);
        $.post("../index.php/register", regUser, function(res){
            if(res){
                console.log(res);
                swal({ 
                    title: "Registration Complete!",
                    text: "Proceed to login",
                    type: "success",
                    timer: 1000,
                    showConfirmButton: false
                },
                    function(){
                        window.location.href = 'login.php';
                });
            }
            else{
                swal("Incorrect Login","Please try again","error")
            }
        },"json");
    }
    return false;
}
//--------------------------------------------------------------------------------------------------------------------
// Login functionality to authenticate a user from the email/username and password entered
// A post request is then made to determine if the email/username and password match
// If a match is found then the user is redirected to the homepage
// If a match is not found then the user is greeted with an error message
// Traders and the administrator log in here and are redirected accordingly based on the credentials entered
var attempts =0;
function login(){
    var email = $("#email").val();
    var password = $("#password").val();
    if(email == "" || password ==""){
        swal({ 
            title: "Incomplete Credentials!",
            text: "Please fill in both username/email and password",
            type: "error",
            timer: 1000,
            showConfirmButton: false
        });
    }
    else{
        var user = {
            "email" : email,
            "password": password
        }

        console.log(user);
        $.post("../index.php/login", user, function(res){
            //console.log(res);
            if(res != 400){
                console.log(res);
                attempts=0;
                 console.log(attempts);

                swal({ 
                    title: res + ", Welcome to JunkTrade!",
                    text: "Login Successful",
                    type: "success",
                    timer: 1000,
                    showConfirmButton: false
                },
                    function(){
                        if(res == "Administrator")
                            window.location.href = 'admin.php';
                        else
                            window.location.href = 'homepage.php';
                });
            }
            else{
                attempts++;
                console.log(attempts);

                if(attempts == 3){
                    swal({
                      title: "Problem!",
                      text: "Your failed 3 login attempts.",
                      showConfirmButton: false,
                      timer: 30000
                   });

                }
                else if(attempts == 5){
                    swal({
                      title: "Problem!",
                      text: "Your failed 5 login attempts..",
                      showConfirmButton: false,
                      timer: 60000
                   });

                }
                else{ 
                    swal("Incorrect Login","Please try again","error");
                    swal({
                      title: "Incorrect Credentials!",
                      text: "Please try again",
                      type: "error",
                      showConfirmButton: false,
                      timer: 1000
                   });
                }
            }
        },"json");
    }
    return false;
}
//--------------------------------------------------------------------------------------------------------------------
// Function that presents the user with a prompt after clicking the logout button
// With options to stay logged in or logout
// If the user chooses logout then they a greeted with a message and redirected to the login page
function logout(){
    swal({
        title: "Logout of JunkTrade?",
        //text: "You will not be able to undo this operation!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, logout",
        cancelButtonText: "Cancel",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm){
        
        if (isConfirm) {
            $.get("../index.php/user",function(userId){
                $.get("../index.php/getusername/"+userId, function(res){
                    var user = {
                        "userid" : userId
                    };

                    $.post("../index.php/logout", user);
                    swal({ 
                        title: "Goodbye " + res.firstname,
                        text: "Thanks for using JunkTrade, see you soon",
                        type: "success",
                        timer: 1000,
                        showConfirmButton: false
                    },
                        function(){
                            window.location.href = 'login.php';
                        }
                    );
                },"json"); 
            },"json");
            

        } else {
            //swal("Still Logged In", "Continue Trading!", "success");
            swal({
                title: "Logout Cancelled!",
                text: "Continue using JunkTrade",
                type: "success",
                timer: 1000,
                showConfirmButton: false
            });
        }
    });
    return false;
}
//------------------------------------------------------------------------------------------------------
// Password recovery functionality
// A user must have a selected a security question and security when registering, that information can now be
// used to reset one's password. The user then enters his/her username/email, selects their security question and answer
// Once the username/email, security question and answer match from the post request, the user is redirected to the 
// form where he/she can update his/her password
function forgotPassword(){
    var email = $("#email").val();
    var securityQuestion = $("#securityquestion").val();
    var sAnswer = $("#sAnswer").val();

    var user = {
        "email" : email,
        "securityquestion" : securityQuestion,
        "sAnswer": sAnswer
    }
    if(email == "" || securityQuestion == "" || sAnswer == ""){
        swal({ 
            title: "Incomplete form!",
            text: "Please fill the in highlighted fields",
            type: "error",
            timer: 1000,
            showConfirmButton: false
        });
    }
    else{
        console.log(user);
        $.post("../index.php/login1", user, function(res){
            if(res != 400){
                //console.log(res);
                swal({ 
                    title: "Correct Security Answer, " + res,
                    text: "Proceed to update your password",
                    type: "success",
                    timer: 1000,
                    showConfirmButton: false
                },
                    function(){
                        window.location.href = 'updatePassword.php';
                });
            }
            else{
                swal({
                    title: "Incorrect Security Answer",
                    text: "Please try again",
                    type: "error",
                    timer: 1000,
                    showConfirmButton: false
                });
            }
        },"json");
    }
    return false;
}
//--------------------------------------------------------------------------------------------------------------------
// Update Password functionality
// Upon successfully entering the correct answer for the security questions, the user to redirected here
// The user enters his/her new password and confirms it. A post request is sent with that information to update
// the user's old password to the new one. Upon completing this, the user is redirected back to the log in page
// to enter his/her new credentials
function updatePassword(){
    console.log("Hi");
    var password = $("#password").val();
    var retypedpassword = $("#retypedpassword").val();

    var regUser = {
        "password" : password
    };
    if(password == "" || retypedpassword ==""){
        swal({ 
            title: "Incomplete form!",
            text: "Please fill in both password fields",
            type: "error",
            timer: 1000,
            showConfirmButton: false
        });
    }
    else{
        console.log(regUser)
        $.post("../index.php/update", regUser, function(res){
            if(res){
                console.log(res);
                swal({ 
                    title: "Password Update Complete!",
                    text: "Proceed to login",
                    type: "success",
                    timer: 1000,
                    showConfirmButton: false 
                },
                    function(){
                        window.location.href = 'login.php';
                });
            }
            else{
                swal("An error has occured","Please try again","error")
            }
        },"json");
    }
    return false;
}

//--------------------------------------------------------------------------------------------------------------------
// Functionality to dsiplay ALL items available for trade (except user items) on the homepage

// This functions accepts the type of sort selected on the homepage by the user
function sortHomepageItems(sortOrder){
    getAllItems(sortOrder);
}

// By default, the sort for the items is in descending order by date
// If the user doesn't select a new sort, then the default is used
// If not then the sort type is passed to the function
// A get request is sent with the sort type and all the items that are not traded nor do not belong
// to the current user are displayed with images, name, when uploaded, views and the request status
function getAllItems(sort){ 
    if(typeof(sort) === 'undefined')
        sort = "mra";
    $.get("../index.php/homepage/"+sort, processAllItems, "json");
}

function processAllItems(records){
    //console.log(records);
    $.get("../index.php/user", function(res){
        //console.log(res);
        listAllItems(records, res);
    },"json");
    
}

function listAllItems(records, user){
    var itemdiv="<div>";
    var requests, i;
    $.get("../index.php/allnonuseritemsstate", function(res){
        requests = res;
        records.forEach(function(el){
            var dateUploaded = moment(el.uploaddate).startOf('minute').fromNow();
            for(i = 0; i < requests.length; i++){
                if(requests[i]['item'] == el['itemid'] || requests[i]['item2'] == el['itemid']){
                    if(requests[i]['decision'] == true){
                        break;
                    }  
                    else {
                        if(requests[i]['requester'] == user){
                            itemdiv += "<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'>"
                            itemdiv += "<div class='panel panel-warning'>";

                            itemdiv += "<div class='panel-heading text-center'><a href='#' style='color: #096790;' onclick=\"viewItem("+el.itemid+")\"><strong>"+ el['itemname'] + "</strong></a><br><small>"+dateUploaded+"  </small><br><button style='color:black;text-decoration:none;' type='button' class='btn btn-default btn-xs' onclick=\"viewTraderProfile("+el.userid+")\">" +  "<strong> by "+ el['username'] + "</strong></button><small> Views: "+el.views+"</small></div>"; 

                            itemdiv += "<div class='panel-body'> <div class='text-center'> </div><img style='cursor: pointer; width:100%;' onclick=\"viewItem("+el.itemid+")\" src=\"" + el['picture'] + "\"  class='img-responsive img-thumbnail mx-auto'></div>";

                             if(requests[i]['decision'] == null){
                                itemdiv += "<div class='panel-footer'> <div class='row'><div class='col-xs-12'><button type='button' class='btn btn-danger btn-block active' onclick=\"cancelMadeRequest("+requests[i]['id']+")\" id='requestbtn'><i class='fa fa-ban fa-lg' aria-hidden='true'></i> Cancel Request</button> </div></div></div>";
                                //console.log("Request Pending for "+ el['itemname']);
                            }

                            else{
                                itemdiv += "<div class='panel-footer'> <div class='row'><div class='col-xs-12'><button type='button' class='btn btn-primary btn-block active' onclick=\"displayItemsForRequest("+el.itemid+")\" id='requestbtn'><i class='fa fa-cart-plus fa-lg' aria-hidden='true'></i> Make Request</button> </div></div></div>";
                            }
                            itemdiv += "</div>";
                            itemdiv += "</div>";
                            break;
                        }
                    }
                }        
            }

            if(i == requests.length){
                itemdiv += "<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'>"

                itemdiv += "<div class='panel panel-info'>";

                itemdiv += "<div class='panel-heading text-center'><a href='#' style='color: #096790;' onclick=\"viewItem("+el.itemid+")\"><strong>"+ el['itemname'] + "</strong></a><br><small> "+ dateUploaded+" </small><br><button style='color:black;text-decoration:none;' type='button' class='btn btn-default btn-xs' onclick=\"viewTraderProfile("+el.userid+")\">" +  "<strong> by "+ el['username'] + "</strong></button><small> Views: "+el.views+"</small></div>"; 

                itemdiv += "<div class='panel-body'> <div class='text-center'> </div><img style='cursor: pointer; width:100%;' onclick=\"viewItem("+el.itemid+")\" src=\"" + el['picture'] + "\"  class='img-responsive img-thumbnail mx-auto'></div>";
            

                itemdiv += "<div class='panel-footer'> <div class='row'><div class='col-xs-12 col-xs-offset-0'><button type='button' class='btn btn-primary btn-block active' onclick=\"displayItemsForRequest("+el.itemid+")\" id='requestbtn'><i class='fa fa-cart-plus fa-lg' aria-hidden='true'></i> Make Request</button> </div></div></div>";
                itemdiv += "</div>";

                itemdiv += "</div>";
            }
        });

        itemdiv += "</div>";
        $("#itemblock").html(itemdiv);
    },"json");   
}
//--------------------------------------------------------------------------------------------------------------------
// Functionality to display ALL the user's items on his/her profile page
// If a request has been accepted for an item, it is considered trader and that is reflected on the profile page
// The status is set to Traded and any functionlity is disabled
// All functionality is available for available items
function getUserItems(){//alter for slim 
    $.get("../index.php/profile", processUserItems, "json");
}

function processUserItems(records){
    //console.log(records);
    listUserItems(records)
}

function listUserItems(records){
    var i, totalCount = 0, availableCount = 0, tradedCount = 0;
    var sec_id = "#table_secp";
    var htmlStr = $("#table_headingp").html(); //Includes all the table, thead and tbody declarations
    $.get("../index.php/accepteduseritems", function(res){
        //console.log(res);
        records.forEach(function(el){
            var date = moment(el['uploaddate']).format('dddd MMMM Do, YYYY');
            for(i = 0; i < res.length; i++){ 
                if(res[i]['item'] == el['itemid'] || res[i]['item2']==el['itemid']){
                    if(res[i]['decision'] == true){
                        htmlStr += "<tr>";
                        htmlStr += "<td style='display:none;'>"+ el['itemid'] +"</td>";
                        htmlStr += "<td style='vertical-align:middle;'><img src=\"" + el['picture'] + "\" width=\"120\" height=\"128\"></td>";
                        htmlStr += "<td style='vertical-align:middle;'><s>"+ el['itemname'] +"</s></td>";
                        htmlStr += "<td style='vertical-align:middle;'><s>"+ el['itemdescription'] +"</s></td>";
                        
                        htmlStr += "<td style='vertical-align:middle;'><button type='button' class='btn btn-primary disabled'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></td>";
                        htmlStr += "<td style='vertical-align:middle;'><button type='button' class='btn btn-danger disabled'><i class='fa fa-trash' aria-hidden='true'></i></button></td>";
                        htmlStr += "<td style='vertical-align:middle;'><s>" + date + "</s></td>";
                        htmlStr += "<td style='vertical-align:middle;'><em> Traded </em> </td>";

                        htmlStr +=" </tr>" ;
                        tradedCount++;
                        break;
                    }
                    else{
                        htmlStr += "<tr>";
                        htmlStr += "<td style='display:none;'>"+ el['itemid'] +"</td>";
                        htmlStr += "<td style='vertical-align:middle;'><img style='cursor: pointer;' onclick=\"viewItemImages("+el.itemid+")\" src=\"" + el['picture'] + "\" width=\"120\" height=\"128\"></td>";
                        htmlStr += "<td style='vertical-align:middle;'>"+ el['itemname'] +"</td>";
                        htmlStr += "<td style='vertical-align:middle;'>"+ el['itemdescription'] +"</td>";
                    
                        htmlStr += "<td style='vertical-align:middle;'><button type='button' class='btn btn-primary' onclick =\"showUpdateForm("+el.itemid+")\"><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></td>";
                        htmlStr += "<td style='vertical-align:middle;'><button type='button' class='btn btn-danger' onclick=\"deleteItem("+el.itemid+")\"><i class='fa fa-trash' aria-hidden='true'></i></button></td>";
                        htmlStr += "<td style='vertical-align:middle;'>" + date + "</td>";
                        htmlStr += "<td style='vertical-align:middle;'><strong> Available </strong></td>";
                        htmlStr +=" </tr>" ;
                        availableCount++;
                        break;
                    }
                    
                }
            }
            if(i == res.length){
                htmlStr += "<tr>";
                htmlStr += "<td style='display:none;'>"+ el['itemid'] +"</td>";
                htmlStr += "<td style='vertical-align:middle;'><img style='cursor: pointer;' onclick=\"viewItemImages("+el.itemid+")\" src=\"" + el['picture'] + "\" width=\"120\" height=\"128\"></td>";
                htmlStr += "<td style='vertical-align:middle;'>"+ el['itemname'] +"</td>";
                htmlStr += "<td style='vertical-align:middle;'>"+ el['itemdescription'] +"</td>";
                    
                htmlStr += "<td style='vertical-align:middle;'><button type='button' class='btn btn-primary' onclick =\"showUpdateForm("+el.itemid+")\"><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></td>";
                htmlStr += "<td style='vertical-align:middle;'><button type='button' class='btn btn-danger' onclick=\"deleteItem("+el.itemid+")\"><i class='fa fa-trash' aria-hidden='true'></i></button></td>";
                htmlStr += "<td style='vertical-align:middle;'>" + date + "</td>";
                htmlStr += "<td style='vertical-align:middle;'><strong> Available </strong></td>";
                htmlStr +=" </tr>" ;
                availableCount++;
            }
        });
        htmlStr += "</tbody></table>";
        $(sec_id).html(htmlStr);
        $("#useritemscountavailable").html(availableCount);
        $("#useritemscounttraded").html(tradedCount);
        $("#useritemscounttotal").html(tradedCount+availableCount);
    },"json");
} 
//--------------------------------------------------------------------------------------------------------------------
// Function to display the full size of all the images of a user's items in a sliding modal
function viewItemImages(itemId){
    $.get("../index.php/itemimages/"+itemId, function(image){
        $('#picture1').attr('src', image.picture);
        $('#picture2').attr('src', image.picture2);
        $('#picture3').attr('src', image.picture3);
        $('#itemimagesmodal').modal('show'); 
    },"json");   
}
//--------------------------------------------------------------------------------------------------------------------
// Function to display the full size of an item image
function viewProfileImage(userId){
    //swal("Working!", "", "success");
    console.log(userId);
    $.get("../index.php/profilepicture/"+userId, function(image){
        console.log(image);
        $('#profilepicture').attr('src', image.profilepicture);
        $('#profilepicturemodal').modal('show'); 
    },"json");  
}
//--------------------------------------------------------------------------------------------------------------------
// Function to display the full size of a user's profile picture
function viewItemImage(image){
    console.log(image);
    $('#profilepicture').attr('src', image);
    $('#profilepicturemodal').modal('show');  
}
//--------------------------------------------------------------------------------------------------------------------
// Functionality to display the number of incoming requests for user items in the notification icon, and a dropdown
// which displays the requester/s and the item/s being requested
// Additionally, more details of the requests are display on the notifications page where the requestee has the option
// to accept or deny a request
function getUserRequests(){
    $.get("../index.php/requests", notifications, "json");  
}

// Function that displays the notification count and listing of notifications
function notifications(records){
    currNotifcations = records;
    //console.log(records);
    var htmlStr="";
    records.forEach(function(el){
        htmlStr += "<li><a href='notifications.php'><img class='img-rounded' src=\"" + el['profilepicture'] + "\" width=\"40\" height=\"45\"> <strong>"+ el.username + "</strong> is requesting <strong>"+ el.itemname + "</strong></a></li>";  
    });

    $("#requests").html(htmlStr);
    var countR = null;
    countR = $("#requests li").length;
    if(countR == 0)
        $("#requestsNotify").html("");
    else
        $("#requestsNotify").html(countR);
    $.get("../index.php/requesteritem", function(res){
        //console.log(res);
        displayRequests(records, res);
    });
}

// Function that displays the listing of incoming requests on the notifications page
function displayRequests(records, res){
    var key;
    var sec_id = "#table_secr";
    var htmlStr = $("#table_headingr").html(); //Includes all the table, thead and tbody declarations
    var i=0;
    //console.log(records);
    records.forEach(function(el){
        var requestId = el['id'];
            var date = moment(el['timerequested']).format('dddd MMMM Do, YYYY');
            htmlStr += "<tr>";
            htmlStr += "<td style='vertical-align:middle;'> <a href='#' onclick=\"viewTraderProfile("+el.requester+")\"><img class='img-rounded' src=\"" + el['profilepicture'] + "\" width=\"40\" height=\"45\"></a>";
            htmlStr += "<button style='color:black;text-decoration:none;' type='button' class='btn btn-link btn-xs' onclick=\"viewTraderProfile("+el.requester+")\">" +  "<strong>"+  " " + el['username'] + "</strong></button></td>";
            htmlStr += "<td style='vertical-align:middle;'><button type='button' style='color:black;text-decoration:none;' class='btn btn-link' onclick=\"viewItem("+res[i]['itemid']+")\"><strong>" + " "+res[i]['itemname']+"<strong></button></td>";
            //htmlStr += "<td></td>";
            htmlStr += "<td style='vertical-align:middle;'><a href='profile.php' class='btn btn-default'> "+el['itemname']+"</a></td>";
            htmlStr += "<td style='vertical-align:middle;'><a href='#' class='btn btn-default'> "+date+"</a></td>";
            //htmlStr += "<td><img src=\"" + pic + "\" width=\"150\" height=\"128\"></td>";    
            //htmlStr += "<td><button type='button' class='btn btn-info btn-block' onclick=\"viewRequest("+el.id+")\"><i class='fa fa-eye' aria-hidden='true'></i></button> ";    
            htmlStr += "<td style='vertical-align:middle;'><button type='button' class='btn btn-success' onclick=\"acceptRequest("+el.id+")\"><i class='fa fa-thumbs-up fa-lg' aria-hidden='true'></i></button> ";
            htmlStr += " <button type='button' class='btn btn-danger' onclick=\"denyRequest("+el.id+")\"><i class='fa fa-thumbs-down fa-lg' aria-hidden='true'></i></button></td>";
            htmlStr +=" </tr>" ;
            i++;
        },"json");
    

    htmlStr += "</tbody></table>";
    $(sec_id).html(htmlStr);
}
//--------------------------------------------------------------------------------------------------------------------
// Functionality to display the count and listing of new/unread decision of requests sent by the user
function getDecisions(){
    $.get("../index.php/decisions", decisions, "json");  
}

function decisions(records){
    $.get("../index.php/decisionsrequestee", function(requestee){
        //console.log(requestee);
        currDecisions = records;
        //console.log(records);
        var htmlStr="", i = 0;
        records.forEach(function(el){
            if(el.decision == true && el.viewed == false){
                htmlStr += "<li><a href='trade.php'><img class='img-rounded' src=\"" + requestee[i]['profilepicture'] + "\" width=\"40\" height=\"45\"><strong> "+ requestee[i]['username'] + " </strong><span class='text-success'><em>accepted</em></span><strong> " +el.itemname + " </strong>request</a></li>";
            }
            else if(el.decision == false && el.viewed == false){
                htmlStr += "<li><a href='trade.php'><img class='img-rounded' src=\"" + requestee[i]['profilepicture'] + "\" width=\"40\" height=\"45\"><strong> "+ requestee[i]['username'] + " </strong><span class='text-danger'><em>denied</em></span><strong> " +el.itemname + " </strong>request</a></li>";
            } 
            i++;
        });
        $("#decisions").html(htmlStr);
        var countD = $("#decisions li").length;
        if(countD == 0)
            $("#decisionsNotify").html("");
        else
            $("#decisionsNotify").html(countD);
    },"json");
}

function getTrade(){
    $.get("../index.php/trade", processUserTrade, "json");
}

function processUserTrade(records){
    //console.log(records);
    $.get("../index.php/outgoingrequestitems", function(res){
        //console.log(res);
        $.get("../index.php/acceptedtradestatus", function(status){
            //console.log(status);
            listUserTrade(records, res, status);
        }, "json");
        
    }, "json");
    //showRequestData(records);
}

function listUserTrade(records, res, status){
    var i=0, j=0, pending = 0, accepted = 0, denied = 0, completed = 0;
    var sec_id = "#table_sect";
    var htmlStr = $("#table_headingt").html(); //Includes all the table, thead and tbody declarations
    //console.log(records);
    records.forEach(function(el){
        //alert(el.rid);
        if(el.viewed == false && el.decision != null){
            var viewedRequest = {
                "requestid" : el.id
            };

            //When the requests page is visited, all request status can be seen so all new request notifications are considered viewed since it would be redundant to have a count for an request that is currently being seen.
            console.log("Set To Viewed called");
            $.post("../index.php/setrequeststoviewed", viewedRequest);
        }
        htmlStr += "<tr>";
        htmlStr += "<td style='vertical-align:middle;'> <a href='#' onclick=\"viewTraderProfile("+el.requestee+")\"><img class='img-rounded' src=\"" + el['profilepicture'] + "\" width=\"40\" height=\"45\">";
        htmlStr += "<button style='color:black;text-decoration:none;' type='button' class='btn btn-link btn-xs'>" +  "<strong>"+  " " + el['username'] + "</strong></button></a></td>";
        /*htmlStr += "<td><button type='button' style='color:black;text-decoration:none;' class='btn btn-link' onclick=\"viewItem("+el.itemid+")\"><strong><i class='fa fa-gift' aria-hidden='true'></i>" + " "+el['itemname']+"<strong></button></td>";
        htmlStr += "<td><i class='fa fa-gift' aria-hidden='true'></i>" + res[i]['itemname']+"</td>";
        htmlStr += "<td>" + el['timerequested'] + "</td>"; */
        var date = moment(el['timerequested']).format('dddd MMMM Do, YYYY');
        if(el['decision'] == null){
            htmlStr += "<td style='vertical-align:middle;'><button type='button' style='color:black;text-decoration:none;' class='btn btn-link' onclick=\"viewItem("+el.itemid+")\"><strong>" + el['itemname']+"<strong></button></td>";
            htmlStr += "<td style='vertical-align:middle;'><a href='profile.php' class='btn btn-default'>" + res[i]['itemname']+"</a></td>";
            htmlStr += "<td style='vertical-align:middle;'>" + date + "</td>";
            htmlStr += "<td class='text-info' style='vertical-align:middle;'> Pending <i class='fa fa-spinner fa-pulse fa-lg fa-fw'></i><span class='sr-only'>Loading...</span></td>";
            htmlStr += "<td style='vertical-align:middle;'>-</td>";
            htmlStr += "<td style='vertical-align:middle;'><button type='button' class='btn btn-danger btn-block active' onclick=\"cancelMadeRequest("+el['id']+")\" id='requestbtn'><i class='fa fa-ban fa-lg' aria-hidden='true'></i> Cancel Request</button></td>";
            pending++;
        }
        else if(el['decision'] == true){
            htmlStr += "<td style='vertical-align:middle;'><button type='button' style='color:black;text-decoration:none;' class='btn btn-link disabled'><strong>" + " "+el['itemname']+"<strong></button></td>";
            htmlStr += "<td style='vertical-align:middle;'><a disabled class='btn btn-default'>" + res[i]['itemname']+"</a></td>";
            htmlStr += "<td style='vertical-align:middle;'>" + date + "</td>";
            if(status[j]['id'] == el.id){
                if(status[j]['requesterfeedbackindicator'] == '1'){
                    htmlStr += "<td class='text-muted' style='vertical-align:middle;'> Trade Complete <i class='fa fa-check-circle fa-lg' aria-hidden='true'></i></td>";
                    htmlStr += "<td style='vertical-align:middle;'>-</td>";
                    htmlStr += "<td style='vertical-align:middle;'>-</td>";
                    completed++;
                }
                else{
                    htmlStr += "<td class='text-success' style='vertical-align:middle;'> Accepted <i class='fa fa-check fa-lg' aria-hidden='true'></i></td>";
                    htmlStr += "<td style='vertical-align:middle;'>-</td>";
                    htmlStr += "<td style='vertical-align:middle;'><button type='button' class='btn btn-success btn-block' onclick=\"meetUp("+el.id+")\"><i class='fa fa-map-marker fa-lg' aria-hidden='true'></i> View Meetup</button></td>";
                    accepted++;
                }
                j++;
            }
            
        }
        else{
            var denyreason = el.denyreason.replace(/\'/g, "\'");
            htmlStr += "<td style='vertical-align:middle;'><button type='button' style='color:black;text-decoration:none;' class='btn btn-link disabled'><strong>" + " "+el['itemname']+"<strong></button></td>";
            htmlStr += "<td style='vertical-align:middle;'><a href='profile.php' class='btn btn-default'>" + res[i]['itemname']+"</a></td>";
            htmlStr += "<td style='vertical-align:middle;'>" + date + "</td>";
            htmlStr += "<td class='text-danger' style='vertical-align:middle;'> Denied <i class='fa fa-ban fa-lg' aria-hidden='true'></i></td>";
            htmlStr += "<td style='vertical-align:middle;'><em>" + denyreason + "</em></td>";
            htmlStr += "<td style='vertical-align:middle;'>-</td>";
            denied++;
        }

        htmlStr +=" </tr>" ;
        i++;
    });
    //count = $("#mylist li").size();
    htmlStr += "</tbody></table>";
    $(sec_id).html(htmlStr);
    $("#pendingrequests").html(pending);
    $("#acceptedrequests").html(accepted);
    $("#deniedrequests").html(denied);
    $("#completedrequests").html(completed);
    $("#totalrequests").html(pending+accepted+denied+completed);

} 

//---------------------------------------------------------------------------------------------------------
// Display as a count and dropdown list, the new messages sent to the user -- unread messages
function newMessagesNotification(){
    $.get("../index.php/newmessagesnotification", processNewMessagesNotification,"json");
}

function processNewMessagesNotification(records){
    currNewMessagesNotification = records;
    //console.log(records);
    displayNewMessagesNotification(records);
}

function displayNewMessagesNotification(records){
    var htmlStr = "";
    records.forEach(function(el){
        htmlStr += "<li><a href='#' onclick=\"chat("+el.sentfrom+")\"><img class='img-rounded' src=\"" + el['profilepicture'] + "\" width=\"40\" height=\"45\"> <strong>"+ el.username + "</strong> messaged you (<strong>" +el.messages+"</strong>)</a></li>";
    });
    $("#messages").html(htmlStr);
    var countM = $("#messages li").length;
    if(countM == 0)
        $("#chatNotify").html("");
    else
        $("#chatNotify").html(countM);

}

//---------------------------------------------------------------------------------------------------------
// Redirects a user to the meetup page when the View Meetup button is clicked
function meetUp(requestid){
    window.location.href = "meetup.php";
}
//---------------------------------------------------------------------------------------------------------
// Functionality to display a user's history of trades made including the feedback given and rating
function getTradeHistory(){
    $.get("../index.php/gettradehistoryrequested", processTradeHistory, "json");
}

function processTradeHistory(records){
    $.get("../index.php/gettradehistoryrequests", function(requests){
        $.get("../index.php/gettradehistoryrequestsuserinfo", function(requestsUser){
            $.get("../index.php/gettradehistoryrequesteduserinfo", function(requestedUser){
                displayTradeHistory(records, requests, requestsUser, requestedUser);
            },"json");  
        },"json");
    },"json");  
}

function displayTradeHistory(records, requests, requestsUser, requestedUser){
    //console.log(records);
    //console.log(requests);
    //console.log(requestsUser);
    //console.log(requestedUser);
    var i = 0, j = 0;
    var sec_id = "#table_sec_tradehistory";
    var htmlStr = $("#table_heading_tradehistory").html(); 
    records.forEach(function(el){
        var tradeDate = moment(el.tradedate).format('dddd MMMM Do, YYYY');
        htmlStr +="<tr>";
        htmlStr +="<td>"+tradeDate+"</td>";
        htmlStr +="<td>"+el.tradelocation+"</td>";
        htmlStr +="<td>"+requestedUser[i]['username']+"</td>";
        htmlStr +="<td>"+requestedUser[i]['itemname']+"</td>";
        htmlStr +="<td>"+el.requesterfeedbackcomment+"</td>";
        htmlStr +="<td>"+el.requesterfeedbackrating+"</td>";
        htmlStr +="<td>"+el.username+"</td>";
        htmlStr +="<td>"+el.itemname+"</td>";
        htmlStr +="<td>"+el.requesteefeedbackcomment+"</td>";
        htmlStr +="<td>"+el.requesteefeedbackrating+"</td>";
        htmlStr +="</tr>";
        i++;
    });

    requests.forEach(function(el){
        var tradeDate = moment(el.tradedate).format('dddd MMMM Do, YYYY');
        htmlStr +="<tr>";
        htmlStr +="<td>"+tradeDate+"</td>";
        htmlStr +="<td>"+el.tradelocation+"</td>";
        htmlStr +="<td>"+el.username+"</td>";
        htmlStr +="<td>"+el.itemname+"</td>";
        htmlStr +="<td>"+el.requesteefeedbackcomment+"</td>";
        htmlStr +="<td>"+el.requesteefeedbackrating+"</td>";
        htmlStr +="<td>"+requestsUser[j]['username']+"</td>";
        htmlStr +="<td>"+requestsUser[j]['itemname']+"</td>";
        htmlStr +="<td>"+el.requesterfeedbackcomment+"</td>";
        htmlStr +="<td>"+el.requesterfeedbackrating+"</td>";
        htmlStr +="</tr>";
        j++;
    });
    htmlStr += "</tbody></table>";
    $(sec_id).html(htmlStr); 
    $("#tradeshistorycount").html(records.length + requests.length);
}
//--------------------------------------------------------------------------------------------------------------
// Displays a listing of all the previous incoming requests to the user for his/her items

function getIncomingRequests(){
    $.get("../index.php/incomingrequestshistoryrequester", processIncomingRequestsHistory, "json");
}

function processIncomingRequestsHistory(records){
    console.log(records);
    $.get("../index.php/incomingrequestshistoryuser", function(res){
        displayIncomingRequestsHistory(records, res);
    },"json")
    
}

function displayIncomingRequestsHistory(records, records2){
    var sec_id = "#table_sec_incomingrequestshistory";
    var htmlStr = $("#table_heading_incomingrequestshistory").html(); 
    var i = 0, accepted = 0, denied = 0;
    records.forEach(function(el){  
        var requestDate = moment(el.timerequested).format('dddd MMMM Do, YYYY');
        htmlStr += "<tr>";
        htmlStr += "<td>"+requestDate+"</td>";  
        htmlStr += "<td>"+el.username+"</td>"; 
        htmlStr += "<td>"+el.itemname+"</td>"; 
        htmlStr += "<td>"+records2[i]['itemname']+"</td>";
        if(el.decision == true){
            htmlStr += "<td>Accepted</td>"; 
            htmlStr += "<td>-</td>";
            accepted++;
        }  
        else{
            var denyreason = el.denyreason.replace(/\'/g, "\'");
            htmlStr += "<td>Denied</td>"; 
            htmlStr += "<td>"+denyreason+"</td>";
            denied++;
        }
            
        htmlStr += "</tr>"; 
        i++;
    })
    htmlStr += "</tbody></table>";
    $(sec_id).html(htmlStr);
    $("#incomingrequestshistorycount").html(records.length);
    $("#acceptedrequestshistory").html(accepted);
    $("#deniedrequestshistory").html(denied);
}
//----------------------------------------------------------------------------------------------------------------
// Function that redirects to the item detail page and loads the data for the item that was clicked
function viewItem(itemid){
    views(itemid); 
    window.location.href = "item.php?item="+itemid;
    return false;
}
//-----------------------------------------------------------------------------------------------------------------
// Function that updates the number of views, by 1, for that item clicked
function views(itemid){
    $.get("../index.php/viewitem/"+itemid, function(res){
        //console.log(res);
    }, "json");
}
//-----------------------------------------------------------------------------------------------------------------
// Function that redirects to the trader detail page and displays the items and other information for that user
function viewTraderProfile(userid){
    window.location.href = 'trader.php?trader='+userid;
    return false;
}
//-----------------------------------------------------------------------------------------------------------------
// Functionality to add the item for which the Save button is clicked to the user's saved items
function addToSavedItems(itemid){
    $.get("../index.php/owner/"+itemid, function(res){
        //console.log(res.id);
        var itemOwner = res.id;
        var item= {
            "itemid": itemid,
            "itemowner": itemOwner
        };

        //console.log(item);
        $.post("../index.php/saveitem", item, function(res){
            //console.log(res);
            if(res){
                //swal("Item Saved!", "You can view item in Saved Items!", "success");
                swal({ 
                    title: "Item Saved!",
                    text: "You can view item in Saved!",
                    type: "success",
                    timer: 1000,
                    showConfirmButton: false
                },
                function(){
                    window.location.reload();
                });
                
                return false;
            }
            else{
                swal("Item Not Saved!", "Sorry, try again", "error");
            }
        },"json"); 
    }, "json");   
}
//-----------------------------------------------------------------------------------------------------------------
// Functionality to remove the item for which the Unsave button is clicked from the user's saved items
function removeSavedItem(savedId){
    var savedItem = {
        "savedid": savedId
    };
    $.post("../index.php/removedsaveditem",savedItem, function(res){
        //console.log(res);
        //swal("Item removed!", "You can save the item again", "error");
        swal({ 
            title: "Item Removed from Saved!",
            text: "You can save the item again!",
            type: "success",
            timer: 1000,
            showConfirmButton: false
        });
        if(window.location.href.indexOf("/item.php?") > -1)
            window.location.reload();
        else
            getUserSavedItems();
    }, "json");
    return false;
}
//---------------------------------------------------------------------------------------------------------------
// Functionality to display the listing of all saved items for the user
function getUserSavedItems(){
    $.get("../index.php/getsaveditems", processUserSavedItems, "json");
}

function processUserSavedItems(records){
    //console.log(records);
    var sec_id = "#table_sec_saveditems";
    var htmlStr = $("#table_heading_saveditems").html(); //Includes all the table, thead and tbody declarations
    records.forEach(function(el){
        var date = moment(el['saveddate']).format('dddd MMMM Do, YYYY');
        htmlStr += "<tr>";
        htmlStr += "<td style='vertical-align:middle;'><a href='#' onclick=\"viewItem("+el.itemid+")\"><img class='img-rounded' src=\"" + el.picture + "\" width=\"120\" height=\"128\"></a></td>";
        htmlStr += "<td style='vertical-align:middle;'><button type='button' style='color:black;text-decoration:none;' class='btn btn-link' onclick=\"viewItem("+el.itemid+")\"><strong>" + " "+el['itemname']+"<strong></button></td>";
        htmlStr += "<td style='vertical-align:middle;'><button style='color:black;text-decoration:none;' type='button' class='btn btn-link' onclick=\"viewTraderProfile("+el.userid+")\">" +  "<strong>"+  " " + el['username'] + "</strong></button></td>";
        htmlStr += "<td style='vertical-align:middle;'>"+ date +"</td>";      
        htmlStr += "<td style='vertical-align:middle;'><button type='button' class='btn btn-danger btn-block' onclick=\"removeSavedItem("+el.savedid+")\"><i class='fa fa-times' aria-hidden='true'></i> Unsave</button></td>";
        htmlStr +=" </tr>" ;
    });

    htmlStr += "</tbody></table>";
    $(sec_id).html(htmlStr);
    $("#savedcount").html(records.length);
    return false;
}
//--------------------------------------------------------------------------------------------------------------------
// Function to add a trader for which the Follow button is clicked to the user's followers
function followTrader(userid){
    var followee = {
        "followee" : userid
    };

    $.post("../index.php/follow",followee, function(res){
        //console.log(res);
        if(res){
            swal({ 
                title: "Trader Followed!",
                text: "You can view followed trader in People!",
                type: "success",
                timer: 1000,
                showConfirmButton: false
            },
                function(){
                    window.location.reload();
            });
        }
        else{
            swal("Trader Not Followed!", "Error!", "error")
        }
    },"json");
}
//--------------------------------------------------------------------------------------------------------------------
// Function to remove a trader for which the Following/Unfollow button is clicked from the user's followers
function unfollowTrader(userid){
    var followee = {
        "followee" : userid
    };

    $.post("../index.php/unfollow", followee, function(res){
        swal({ 
            title: "Trader Unfollowed!",
            text: "You can follow them again!",
            type: "success",
            timer: 1000,
            showConfirmButton: false
        });

        if(window.location.href.indexOf("/trader.php") > -1)
            window.location.reload();
        else
            getUserFollowees();
    }, "json");    
}
//--------------------------------------------------------------------------------------------------------------------
// Functionality to display a listing of all the traders that the user is following
function getUserFollowees(){
    $.get("../index.php/followees", processUserFollowees, "json");
}

function processUserFollowees(records){
    //console.log(records);
    var sec_id = "#table_sec_followees";
    var htmlStr = $("#table_heading_followees").html(); //Includes all the table, thead and tbody declarations
    records.forEach(function(el){
        var date = moment(el['followdate']).format('dddd MMMM Do, YYYY');
        htmlStr += "<tr>";
        htmlStr += "<td style='vertical-align:middle;'><a href='#' onclick=\"viewTraderProfile("+el.followee+")\"><img class='img-rounded' src=\"" + el.profilepicture + "\" width=\"120\" height=\"128\"></a></td>";
        htmlStr += "<td style='vertical-align:middle;'><button style='color:black;text-decoration:none;' type='button' class='btn btn-link' onclick=\"viewTraderProfile("+el.followee+")\">" +  "<strong>"+  " " + el['username'] + "</strong></button></td>";
        htmlStr += "<td style='vertical-align:middle;'>"+ date +"</td>";      
        htmlStr += "<td style='vertical-align:middle;'><button type='button' class='btn btn-danger btn-block' onclick=\"unfollowTrader("+el.followee+")\"><i class='fa fa-times' aria-hidden='true'></i> Unfollow</button></td>";
        htmlStr +=" </tr>" ;
    });

    htmlStr += "</tbody></table>";
    $(sec_id).html(htmlStr);
    $("#followingcount").html(records.length);
    return false;
}
//--------------------------------------------------------------------------------------------------------------------
// Functionality to display a listing of all the traders that are following the user
function getUserFollowers(){
    $.get("../index.php/followers", processUserFollowers, "json");
}

function processUserFollowers(records){
    //console.log(records);
    var sec_id = "#table_sec_followers";
    var htmlStr = $("#table_heading_followers").html(); //Includes all the table, thead and tbody declarations
    records.forEach(function(el){
        var date = moment(el['followdate']).format('dddd MMMM Do, YYYY');
        htmlStr += "<tr>";
        htmlStr += "<td style='vertical-align:middle;'><a href='#' onclick=\"viewTraderProfile("+el.follower+")\"> <img class='img-rounded' src=\"" + el.profilepicture + "\" width=\"120\" height=\"128\"></a></td>";
        htmlStr += "<td style='vertical-align:middle;'><button style='color:black;text-decoration:none;' type='button' class='btn btn-link' onclick=\"viewTraderProfile("+el.follower+")\">" +  "<strong>"+ " "+el['username'] + "</strong></button></td>";
        htmlStr += "<td style='vertical-align:middle;'>"+ date +"</td>";      
        htmlStr +=" </tr>" ;
    });

    htmlStr += "</tbody></table>";
    $(sec_id).html(htmlStr);
    $("#followerscount").html(records.length);
    return false;
}
//--------------------------------------------------------------------------------------------------------------------
// Function to show forms on first click and hide on second click
function toggler(divId) {
    $("#" + divId).toggle("slow");
}
//--------------------------------------------------------------------------------------------------------------------
// Show and hide add item form
function showForm(){
    $('#uploadItem').show("slow");

}
function hideForm(){
    $('#uploadItem').hide("slow");

}
//-------------------------------------------------------------------------------------------
//Shows the upload profile picture form when the "Update Profile Pic" button is clicked
function showProfilePictureForm(){
    $('#uploadProfilePic').show("slow");

}

//Hides the upload profile picture form when the "Cancel" button is clicked
function hideProfilePictureForm(){
    $('#uploadProfilePic').hide("slow");

}
//----------------------------------------------------------------------------------------------------------------------
//show and hide search bar 
function showSearch(){
    $('#ProfileSearch').show("slow");

}
function hideSearch(){
    $('#ProfileSearch').hide("slow");

}

//----------------------------------------------------------------------------------------------------------------------
//show and hide profile edit bar 
function showEditProfileForm(){
   
$('#editProfileForm').show("slow");

    $.get("../index.php/user", function(res){
        var usr = res;
        
       $.get("../index.php/editprofile/"+usr, function(user){
        $("#username").val(user.username);
        $("#firstname").val(user.firstname);
        $("#lastname").val(user.lastname);
        $("#email").val(user.email);
        $("#telephone").val(user.telephone);
    }, "json");
}, "json");
}
function hideEditProfileForm(){
    $('#editProfileForm').hide("slow");

}
//--------------------------------------------------------------------------------------------------------------------
// Show and hide edit item form
function showUpdateForm(itemid){
   $('#updateItemform').show("slow");
   $.get("../index.php/edititem/"+itemid, function(item){
        //$("#imageU").val(item.picture);
        //$("#imageU2").val(item.picture2);
        //$("#imageU2").val(item.picture3);
        $("#id").val(item.itemid);
        $("#itemnameU").val(item.itemname);
        $("#itemdescriptionU").val(item.itemdescription);
    }, "json");
}
function hideUpdateForm(){
    $('#updateItemform').hide("slow");

}
//--------------------------------------------------------------------------------------------------------------------
// Functionality to make a request for an item which involves selecting from a list of available items of the current user
function displayItemsForRequest(itemid){
    $.get("../index.php/user", function(res){
        var user = res;
        //console.log(user);
        $.get("../index.php/items/"+user, function(res){
            //console.log(res);
            displayInModal(res, itemid);
        }, "json")
    }, "json");
    
}

function displayInModal(records, itemid){
    if ($("#requesteritem").length > 0){ 
        $.get("../index.php/accepteduseritems", function(res){
            //console.log(res);
            var htmlStr, i;
            records.forEach(function(item){
                for(i = 0; i < res.length; i++){
                    if(res[i]['item'] == item.itemid || res[i]['item2'] == item.itemid){
                        if(res[i]['decision'] == true){
                            break;
                        }
                        else{
                            htmlStr += "<option value='"+item.itemid+"'>"+item.itemname+"</option>";
                            break;
                        }
                    }
                }
                if(i == res.length){
                    htmlStr += "<option value='"+item.itemid+"'>"+item.itemname+"</option>";
                }
            });
            if(records.length != 0 || records == null)
                $("#requestercontact").val(records[0]['telephone']);
            $("#requesteritem").html(htmlStr);
        },"json");
    } 
    $.get("../index.php/owner/"+itemid, function(res){
        //console.log(res);
        $("#requestee").val(res.username);
        $("#requesteeitem").val(res.itemname);
    }, "json") 

    $("#requestModal").modal('show');
}

function sendRequest(){
    var requestee = $("#requestee").val();
    var requesteeItem = $("#requesteeitem").val();
    var requesterItem = $("#requesteritem").val();
    var requesterContact = $("#requestercontact").val();

    var request = {
        "requestee" : requestee,
        "requesteeitem" : requesteeItem,
        "requesteritem" : requesterItem,
        "requestercontact" : requesterContact
    };

    //console.log(request);
    swal(
        {
            title: "Send Request for \"" + requesteeItem + "\"?",
            //text: "You will not be able to undo this operation!",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#5cd65c",
            confirmButtonText: "Send",
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
            if (isConfirm) {
                $.post("../index.php/request", request, function(res){
                    //console.log(res);
                    if (res.id && res.id > 0){
                        //swal("Request Made!", "Trader will be notified", "success");
                        swal({ 
                            title: "Request Sent!",
                            text: "Trader will be notified",
                            type: "success",
                            timer: 1000,
                            showConfirmButton: false
                            });
                        if(window.location.href.indexOf("/item.php?") > -1 || window.location.href.indexOf("/trader.php") > -1 || window.location.href.indexOf("/search.php") > -1){
                            window.location.reload();
                                }
                        else{
                            getAllItems(); 
                        }
                    }  
                },"json"); 
            } 

            else {
                cancelRequest();
            }
        }
    );
    
    $('#requestModal').modal('hide');
    return false;
}

//--------------------------------------------------------------------------------------------------------------------
// Function to hide the request modal and display a message to the user
function cancelRequest(){
    $('#requestModal').modal('hide');
    //swal("Request Cancelled!", "You can make another request", "error");
    swal({
        title: "Request Cancelled!",
        text: "You can make another request",
        type: "error",
        timer: 1000,
        showConfirmButton: false
    });   
    return false;
}
//------------------------------------------------------------------------------------------------------------------
// Function to cancel a request for an item that the user already sent
function cancelMadeRequest(requestId){
    swal({
        title: "Cancel Sent Request?",
        //text: "You will not be able to undo this operation!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, Cancel!",
        cancelButtonText: "No, Keep!",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm){
        
        if (isConfirm) {
            var request = {
                "requestid" : requestId
            }; 
            //console.log(request);
            $.post("../index.php/cancelrequest", request, function(res){
                //swal("Request Cancelled!", "The owner will no longer see your request", "success");
                swal({ 
                    title: "Request Cancelled!",
                    text: "Trader will no longer see your request",
                    type: "error",
                    timer: 2000,
                    showConfirmButton: false
                    });
                if(window.location.href.indexOf("/item.php?") > -1 || window.location.href.indexOf("/trader.php") > -1 || window.location.href.indexOf("/search.php") > -1){
                    window.location.reload();
                }
                else if(window.location.href.indexOf("/trade.php") > -1 ){
                    getTrade();
                }
                else{
                    getAllItems();
                }
            }, "json");
            
        } else {
            //swal("Cancelled", "Your request is still pending", "error");
            swal({
                title: "Cancelled!",
                text: "The request is still pending",
                type: "success",
                timer: 1000,
                showConfirmButton: false
            });
        }
    });
}
//--------------------------------------------------------------------------------------------------------------------
// Function to delete an item from the list of user items
// An item can only be deleted if there are no requests pending for it
function deleteItem(itemid){
    swal({
            title: "Delete Item?",
            text: "You will not be able to undo this operation",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
            if (isConfirm) {
                $.get("../index.php/requeststatus/"+itemid, function(res){
                    var count = parseInt(res[0][0]) + parseInt(res[1][0]);
                    //console.log("Pending requests: " + count);
                    if(count != 0){
                        //swal("Requests Pending: "+count, "Cannot delete item!", "error");
                        swal({
                            title: "Requests Pending: " + count,
                            text: "Unable to delete item!",
                            type: "error",
                            timer: 2000,
                            showConfirmButton: false
                        });   
                    }
                    else{
                        $.get("../index.php/deleteitem/"+itemid, function(res){
                            //swal("Item Deleted!", "Your item has been deleted!", "success");
                            swal({
                                title: "Item Deleted!",
                                text: "Traders will no longer see your item",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false
                            }); 
                            getUserItems(); 
                        }, "json"); 
                    }  
                }, "json");
            } 
            else {
                //swal("Cancelled", "Your item is safe", "error");
                swal({
                    title: "Cancelled!",
                    text: "Your item is still available for trade",
                    type: "success",
                    timer: 2000,
                    showConfirmButton: false
                }); 
            }
        }
    );
    
}
//-------------------------------------------------------------------------------------------------------------------
// Functionality to accept a request sent to a user and to propose the meet up details
function acceptRequest(requestId){
    $("#meetupform #requestid").val(requestId);

    $.get("../index.php/requester/"+requestId, function(res){
        //console.log(res);

        $("#meetupform #requester").val(res.username);
        $("#meetupform #requesteritemid").val(res.itemid);
        $("#meetupform #requesteritem").val(res.itemname);
        $("#meetupform #requestercontact").val(res.requestercontact);

        $.get("../index.php/requestee/"+requestId, function(res){
            //console.log(res);
            $("#meetupform #requesteecontact").val(res.telephone);
            $("#meetupform #requesteeitemid").val(res.itemid);
            $("#meetupform #requesteeitem").val(res.itemname);
        }, "json");
        
        //console.log(res);

    },"json");
    $("#meetUpModal").modal('show');
}

function sendArrangement(){
    var requestId = $("#meetupform #requestid").val();
    var requesterItem = $("#meetupform #requesteritemid").val();
    var requesteeItem = $("#meetupform #requesteeitemid").val();

    var request = {
        "requestid" : requestId,
        "requesteritem" : requesterItem,
        "requesteeitem" : requesteeItem
    };
    console.log(request);
    $("#meetUpModal").modal('hide');

    swal({
        title: "Accept Request and Send Arrangement?",
        //text: "You will not be able to undo this operation!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#5cd65c",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm){
        if (isConfirm) {
            $.post("../index.php/acceptrequest", request, function(res){
                //console.log(res);
                arrangement();
                //swal("Request Accepted and Arrangment Sent!", "The trader will be notified", "success");
                swal({
                    title: "Request Accepted and Arrangment Sent!",
                    text: "The trader will be notified!",
                    type: "success",
                    timer: 2000,
                    showConfirmButton: false
                });
                
                getUserRequests();
                //return false;
            }, "json");
            
        } else {
            //swal("Cancelled", "Request and Arrangement still Pending", "error");
            swal({
                title: "Cancelled!",
                text: "Request and Arrangement still Pending",
                type: "error",
                timer: 2000,
                showConfirmButton: false
            });
        }
    });
    return false;   
}

function arrangement(){
    var requestId = $("#meetupform #requestid").val();
    var tradeDate = $("#meetupform #tradedate").val();
    var tradeLocation = $("#meetupform #tradelocation").val();
    var requesteeContact = $("#meetupform #requesteecontact").val();
    var requesterContact = $("#meetupform #requestercontact").val();
    tradeDate = moment(tradeDate).format('YYYY-MM-DD 00:00:00');
    //alert(tradeDate);
    var trade = {
        "requestid" : requestId,
        "tradedate" : tradeDate,
        "tradelocation" : tradeLocation,
        "requesteecontact" : requesteeContact,
        "requestercontact" : requesterContact
    };

    console.log(trade);
    $.post("../index.php/tradearrangement", trade, function(res){
        console.log(res);
        //swal("Arrangement Sent!", "Good stuff!", "success")
    },"json");
    return false;
}
//---------------------------------------------------------------------------------------------------------------------
// Function to display a greeting when the user Cancel while accepting a request
function cancelArrangement(){
    //sweetAlert("Cancelled", "Request and Arrangement still Pending", "error");
    swal({
        title: "Cancelled!",
        text: "Request and Arrangement still Pending",
        type: "error",
        timer: 1000,
        showConfirmButton: false
    });
    return false;
}
//--------------------------------------------------------------------------------------------------------------------
// Function to deny a request sent to a user and send an appropriate reason for denying his/her request
function denyRequest(requestId){
    var denyReason="";
    swal({
        title: "Deny Request?",
        text: "Tell Trader Why",
        type: "input",
        confirmButtonColor: "#DD6B55",
        showCancelButton: true,
        closeOnConfirm: false,
        animation: "slide-from-top",
        inputPlaceholder: "Leave a reason",
        confirmButtonText: "Send Reason"
        },

        function(inputValue){
            
            if (inputValue === false){
                return false;
            }
      
            if (inputValue === "") {
                swal.showInputError("Kindly leave a reason for denying request");
                return false
            }
            denyReason = inputValue.replace(/'/g, "\\'");
            var deniedRequest = {
                "requestid": requestId,
                "denyreason" : denyReason
            };

            console.log(deniedRequest);
            $.post("../index.php/denyrequest", deniedRequest, function(res){
                //console.log(res);
                swal({
                    title: "Request Denied!",
                    text: "Decision and Reason sent to Trader",
                    type: "success",
                    timer: 2000,
                    showConfirmButton: false
                });
            }, "json");
        }
    );
}

//--------------------------------------------------------------------------------------------------------------------
// Functionality to display a listing of meetup details of items that the user made requests for
function getRequestedMeetUp(){
    $.get("../index.php/requestedmeetuprequestee", function(res1){
        //console.log(res1);
        $.get("../index.php/requestedmeetuprequester",function(res2){
            //console.log(res2);
            processRequestedMeetUp(res1,res2);
        },"json");
    },"json");

} 

function processRequestedMeetUp(records, records2){
    //console.log(records);
    var sec_id = "#table_sec_requested";
    var htmlStr = $("#table_heading_requested").html(); //Includes all the table, thead and tbody declarations
    var i = 0, size = records2.length -1;
    //console.log(size);
    //console.log(records[1][0]);
    //var currDate = new Date();
    records.forEach(function(el){
        var date = moment(el['tradedate']).format('dddd MMMM Do, YYYY');
        htmlStr += "<tr>";
        htmlStr += "<td style='vertical-align:middle;'> <a href='#' onclick=\"viewTraderProfile("+el.requestee+")\"><img class='img-rounded' src=\"" + el['profilepicture'] + "\" width=\"40\" height=\"45\"></a>"
        htmlStr += "<button style='color:black;text-decoration:none;vertical-align:middle;' type='button' class='btn btn-link btn-xs' onclick=\"viewTraderProfile("+el.requestee+")\">" +  "<strong>"+  " " + el['username'] + "</strong></button></td>"
        htmlStr += "<td style='vertical-align:middle;'><button type='button' class='btn btn-default' onclick =\"chat("+el.requestee+")\"><i class='fa fa-comments' aria-hidden='true'></i></button></td>";

        htmlStr += "<td style='vertical-align:middle;'>"+el['requesteecontact']+"</td>"
        htmlStr += "<td style='vertical-align:middle;'><button type='button' style='color:black;text-decoration:none;' class='btn btn-link disabled'><strong>" + " "+el['itemname']+"<strong></button></td>"
        htmlStr += "<td style='vertical-align:middle;'>"+records2[i]['itemname']+"</td>";
        htmlStr += "<td style='vertical-align:middle;'>" + date + "</td>";
        htmlStr += "<td style='vertical-align:middle;'>" + el['tradelocation'] + "</td>";
        //htmlStr += "<td><button type='button' class='btn btn-info' onclick =\"suggestLocation("+el.tradeid+")\"><i class='fa fa-edit' aria-hidden='true'></i></button></td>";
        var now = moment().format('YYYY-MM-DD hh:mm:ss');
        //alert(now > el.tradedate);
        if(moment(now).isAfter(el.tradedate)){
            htmlStr += "<td style='vertical-align:middle;'><button type='button' class='btn btn-info' onclick =\"showRequesterFeedbackForm("+el.tradeid+")\" data-toggle='tooltip' data-placement='bottom' title='Give feedback to remove transaction'><i class='fa fa-commenting-o' aria-hidden='true'></i></button></td>";
        }
        else{
            htmlStr += "<td style='vertical-align:middle;'><button type='button' class='btn btn-info disabled' data-toggle='tooltip' data-placement='bottom' title='Unable to give feedback, trade date not passed yet'><i class='fa fa-commenting-o' aria-hidden='true'></i></button></td>";
        }
        
        htmlStr +=" </tr>" ;
        i++;
    });
    //count = $("#mylist li").size();
    htmlStr += "</tbody></table>";
    $(sec_id).html(htmlStr); 
    $("#requestedcount").html(records.length); 
}


//------------------------------------------------------------------------------------------------------------------------
// Functionality to display a listing of meetup details of the user's items that other users requested
function getRequestsMeetUp(){
     $.get("../index.php/requestsmeetuprequestee", function(res1){
        //console.log(res1);
        $.get("../index.php/requestsmeetuprequester",function(res2){
            //console.log(res2);
            processRequestsMeetUp(res1, res2);
        },"json");
    },"json");
}

function processRequestsMeetUp(records, records2){
    //console.log(records);
    var sec_id = "#table_sec_requests";
    var htmlStr = $("#table_heading_requests").html(); //Includes all the table, thead and tbody declarations
    var i = 0;

    records2.forEach(function(el){
        var date = moment(el['tradedate']).format('dddd MMMM Do, YYYY');
        htmlStr += "<tr>";
        htmlStr += "<td style='vertical-align:middle;'> <a href='#' onclick=\"viewTraderProfile("+el.requester+")\"><img class='img-rounded' src=\"" + el['profilepicture'] + "\" width=\"40\" height=\"45\"></a>"
        htmlStr += "<button style='color:black;text-decoration:none;vertical-align:middle;' type='button' class='btn btn-link btn-xs' onclick=\"viewTraderProfile("+el.requester+")\">" +  "<strong>"+  " " + el['username'] + "</strong></button></td>";
        htmlStr += "<td style='vertical-align:middle;'><button type='button' class='btn btn-default' onclick =\"chat("+el.requester+")\"><i class='fa fa-comments' aria-hidden='true'></i></button></td>";
        htmlStr += "<td style='vertical-align:middle;'>"+el['requestercontact']+"</td>";
        htmlStr += "<td style='vertical-align:middle;'><button type='button' style='color:black;text-decoration:none;' class='btn btn-link disabled'><strong>" + " "+el['itemname']+"<strong></button></td>";
        htmlStr += "<td style='vertical-align:middle;'>"+records[i]['itemname']+"</td>";
        htmlStr += "<td style='vertical-align:middle;'>" + date + " <button type='button' class='btn btn-default btn-xs' onclick=\"editTradeDate("+el.tradeid+")\"> <i class='fa fa-pencil' aria-hidden='true'></i></button></td>";
        htmlStr += "<td style='vertical-align:middle;'>" + el['tradelocation'] + " <button type='button' class='btn btn-default btn-xs' onclick=\"editTradeLocation("+el.tradeid+")\"> <i class='fa fa-pencil' aria-hidden='true'></i></button></td>";
        
        var now = moment().format('YYYY-MM-DD hh:mm:ss');
        //alert(now);
        //alert(el.tradedate);
        if(moment(now).isAfter(el.tradedate)){
            htmlStr += "<td style='vertical-align:middle;'><button type='button' class='btn btn-info' onclick =\"showRequesteeFeedbackForm("+el.tradeid+")\" data-toggle='tooltip' data-placement='bottom' title='Give feedback to remove transaction'><i class='fa fa-commenting-o' aria-hidden='true'></i></button></td>";
        }
        else{
            htmlStr += "<td style='vertical-align:middle;'><button type='button' class='btn btn-info disabled' data-toggle='tooltip' data-placement='bottom' title='Unable to give feedback, trade date not passed yet'> <i class='fa fa-commenting-o' aria-hidden='true'></i></button></td>";
        }
        
        htmlStr +="</tr>" ;
        i++;
    });
    //count = $("#mylist li").size();
    htmlStr += "</tbody></table>";
    $(sec_id).html(htmlStr); 
    $("#requestscount").html(records2.length); 
}

//------------------------------------------------------------------------------------------------------------------------
// Functionality for the requestee to modify the proposed meetup date
function editTradeDate(tradeId){
    $("#editdateform #tradeid").val(tradeId);
    $("#editDateModal").modal('show');
    
    return false;
}

function changeTradeDate(){
    $("#editDateModal").modal('hide');
    var newTradeDate = $("#editdateform #newtradedate").val();
    newTradeDate = moment(newTradeDate).format('YYYY-MM-DD 00:00:00');
    var tradeId = $("#editdateform #tradeid").val();

    var tradeDateDetails = {
        "tradeid": tradeId,
        "newtradedate" : newTradeDate
    };
    //console.log(tradeDateDetails);
    $.post("../index.php/changetradedate", tradeDateDetails, function(res){
        //console.log(res);
        swal({
            title: "Trade Date modified!",
            text: "Requester will see change",
            type: "success",
            timer: 1000,
            showConfirmButton: false
        }); 
    },"json");
    getRequestsMeetUp();
    return false;
}
//------------------------------------------------------------------------------------------------------------------------
// Functionality for the requestee to modify the proposed meetup location
function editTradeLocation(tradeId){
    $("#editlocationform #tradeid").val(tradeId);
    $("#editLocationModal").modal('show');
    
    return false;
}

function changeTradeLocation(){
    $("#editLocationModal").modal('hide');
    var newTradeLocation = $("#editlocationform #newtradelocation").val();
    var tradeId = $("#editlocationform #tradeid").val();

    var tradeLocationDetails = {
        "tradeid": tradeId,
        "newtradelocation" : newTradeLocation
    };
    //alert(tradeLocationDetails);
    $.post("../index.php/changetradelocation", tradeLocationDetails, function(res){
        //console.log(res);
        swal({
            title: "Trade Location modified!",
            text: "Requester will see change",
            type: "success",
            timer: 1000,
            showConfirmButton: false
        }); 
    },"json");
    getRequestsMeetUp();
    return false;
}
//------------------------------------------------------------------------------------------------------------------------
// Function to display a greeting to the user if the cancel button is clicked
function cancelEdit(){
    swal({
        title: "Cancelled!",
        text: "Nothing modified",
        type: "error",
        timer: 1000,
        showConfirmButton: false
    });
    return false;
}
//-----------------------------------------------------------------------------------------------------------------------
// Functionality to display a feedback form with a rating and comments for the requester to rate the requestee
function showRequesterFeedbackForm(tradeId){
    $("#requesterfeedbackform #tradeid").val(tradeId);
    $('#requesterFeedbackModal').modal('show');
}

function requesterFeedback(){
    $('#requesterFeedbackModal').modal('hide');
    var tradeId = $("#requesterfeedbackform #tradeid").val();
    var rating = $("#requesterfeedbackform #rating").val();
    var comment = $("#requesterfeedbackform #feedbackcomment").val();
    var feedback = {
        "tradeid" : tradeId,
        "rating" : rating,
        "comment" : comment
    };

    //console.log(feedback);
    $.post("../index.php/requesterfeedback", feedback, function(res){
        //swal("Feedback saved!", "Thank you for your rating and comment", "success");
        swal({
            title: "Feedback saved!",
            text: "Thank you for your rating and comment",
            type: "success",
            timer: 1000,
            showConfirmButton: false
        });
        getRequestedMeetUp();
    }, "json");
    return false;
}
//-----------------------------------------------------------------------------------------------------------------------
// Functionality to display a feedback form with a rating and comments for the requestee to rate the requester
function showRequesteeFeedbackForm(tradeId){
    $("#requesteefeedbackform #tradeid").val(tradeId);
    $('#requesteeFeedbackModal').modal('show');

}

function requesteeFeedback(){
    $('#requesteeFeedbackModal').modal('hide');
    var tradeId = $("#requesteefeedbackform #tradeid").val();
    var rating = $("#requesteefeedbackform #rating").val();
    var comment = $("#requesteefeedbackform #feedbackcomment").val();
    var feedback = {
        "tradeid" : tradeId,
        "rating" : rating,
        "comment" : comment
    };
    
    //console.log(feedback);
    $.post("../index.php/requesteefeedback", feedback, function(res){
        //swal("Feedback saved!", "Thank you for your rating and comment", "success");
        swal({
            title: "Feedback saved!",
            text: "Thank you for your rating and comment",
            type: "success",
            timer: 1000,
            showConfirmButton: false
        });
        getRequestsMeetUp();
    }, "json");
    return false;
}
//-----------------------------------------------------------------------------------------------------------------------
// Function to display a greeting when the user chooses to cancel sending feedback
function cancelFeedback(){
    //swal("Cancelled!", "Feedback not saved!", "error");
    swal({
        title: "Cancelled!",
        text: "Feedback not saved; kindly rate this trade",
        type: "error",
        timer: 2000,
        showConfirmButton: false
    });
}
//------------------------------------------------------------------------------------------------
// Functionality to provide a chat between two users
var currChat = [], chatInterval=null;
function chat(traderid){
    //console.log(traderid);
    var chatId;
    $.get("../index.php/user",function(userid){
        //console.log(userid);
        $("#chatform #userid").val(userid);
        $("#chatform #traderid").val(traderid);

        $.get("../index.php/getusername/"+traderid,function(trader){
            //console.log(username);
            var username;
            username = trader.username;
            $("#chatform #traderusername").val(trader.username);
            $("#chatform #tradername").text(trader.firstname + " " + trader.lastname);

            getMessages(traderid, userid, username);        
            chatInterval = setInterval(function(){
                //console.log(traderid);
                getNewMessages(traderid, userid, username);
            },2000);   
            $("#chatmodal").modal('show');
            $("#chatmodal").on("hidden.bs.modal", function () {
                clearInterval(chatInterval);
                console.log("Chat closed and Interval stopped");
            });
        },"json");
        
    });
}

function sendMessage(){ 
    var sentFrom = $("#chatform #userid").val();
    var sentTo = $("#chatform #traderid").val();
    var message = $("#chatform #message").val();
    message = message.replace(/'/g, "\\'");
    //message = encodeURIComponent(message).replace(/'/g,"%27");
    var traderName = $("#chatform #traderusername").val();
    //console.log(traderName);
    var chat = {
        "sentfrom" : sentFrom,
        "sentto" : sentTo,
        "message" : message
    };

    $("#chatform #message").val("");
    //console.log(chat);
    
    $.post("../index.php/sendmessage", chat, function(res){
        if(res){
            getMessages(sentTo, sentFrom, traderName);
        }
        else{
            swal("Message Failed", "Message not sent", "error");
        }
    }, "json");
    return false;
}


function getMessages(traderid, userid, username){
    $.get("../index.php/getmessages/"+traderid, function(messages){
        currChat = messages;
        var currMessages = $("#chatform #messages").val();
        //console.log("getMessages  called");
        var chat="", divchat="<div class='container-fluid'>",chatId, isRead, sentDate;

        $.get("../index.php/userstatus/"+traderid, function(res){
            if(res.status == "1")
                $("#chatform #traderstatus").text("- online");
            else
                $("#chatform #traderstatus").text("- offline");
        },"json");

        messages.forEach(function(el){
            var message = el.message.replace(/\'/g, "\'");
            var messageDate = moment(el['senton']).format('MMMM Do YYYY, h:mm:ss a');
            chatId = {
                "chatid" : el.chatid
            };

            $.post("../index.php/readmessage", chatId); 
            sentDate =  moment(el.senton).startOf('seconds').fromNow();
            if(el.readindicator == '1')
                isRead = "<i class='fa fa-check-circle' aria-hidden='true'></i>";
            else
                isRead = "<i class='fa fa-check-circle-o' aria-hidden='true'></i>";

            if(el.sentfrom == userid){
                divchat += "<div class='row'><div class='well well-sm pull-right' data-toggle='tooltip'  data-placement='left'title=\""+messageDate+"\" ><strong>Me</strong>: "+message+" "+isRead+"<br/><small><small>"+sentDate+"</small></small></div></div>";
            }
            else{  
                divchat += "<div class='row'><div class='well well-sm pull-left' data-toggle='tooltip' data-placement='right' title=\""+messageDate+"\" ><strong>"+username +"</strong>: "+message+" "+isRead+"<br/> <small><small>"+sentDate+"</small></small></div></div>";  
            }      
        });

        divchat+="</div>";
        //$("#chatform #messages").html(chat);
        $("#chatform #divmessages").html(divchat);
        var element = document.getElementById("divmessages");
        element.scrollTop = element.scrollHeight;
    }, "json");
}

function getNewMessages(traderid, userid, username){
    //console.log(username);
    $.get("../index.php/getmessages/"+traderid, function(messages){   
        $.get("../index.php/userstatus/"+traderid, function(res){
            if(res.status == "1")
                $("#chatform #traderstatus").text("- online");
            else
                $("#chatform #traderstatus").text("- offline");
        },"json");  

        var chat="",chatId, divchat="<div class='container-fluid'>";
        if(JSON.stringify(messages) !== JSON.stringify(currChat) && $('#chatmodal').hasClass('in')){
            //console.log("New Message/s");
            currChat = messages;

            messages.forEach(function(el){
                var message = el.message.replace(/\'/g, "\'");
                chatId = {
                    "chatid" : el['chatid']
                };
                var messageDate = moment(el['senton']).format('MMMM Do YYYY, h:mm:ss a');


                $.post("../index.php/readmessage", chatId);
                var sentDate =  moment(el.senton).startOf('seconds').fromNow();
                var isRead;
                if(el.readindicator == '1')
                    isRead = "<i class='fa fa-check-circle' aria-hidden='true'></i>";
                else
                    isRead = "<i class='fa fa-check-circle-o' aria-hidden='true'></i>";

                if(el.sentfrom == userid){
                    divchat += "<div class='row'><div class='well well-sm pull-right' data-toggle='tooltip'  data-placement='left'title=\""+messageDate+"\" ><strong>Me</strong>: "+message+" "+isRead+"<br/><small><small>"+sentDate+"</small></small></div></div>";
                }
                else{  
                    divchat += "<div class='row'><div class='well well-sm pull-left' data-toggle='tooltip' data-placement='right' title=\""+messageDate+"\" ><strong>"+username +"</strong>: "+message+" "+isRead+"<br/> <small><small>"+sentDate+"</small></small></div></div>";  
                }      
                                
            });
            divchat+="</div>";
            $("#chatform #divmessages").html(divchat);
            var element = document.getElementById("divmessages");
            element.scrollTop = element.scrollHeight;  
        }
    },"json");
}



//------------------------------------------------------------------------------------------------------------
// Functionality to display upcoming meetups that the user has with other traders
function userMeetUp(){
    $.get("../index.php/usermeetup",processUserMeetUp,"json");

}

function processUserMeetUp(records){
    //console.log(records);
    displayUserMeetUp(records);
}

function displayUserMeetUp(records){
    var events="<div class='container-fluid'>";
    var eventsCount = 0;
    //console.log(records.length);
    if(records.length != 0){
        for(var i = 0; i < records.length; i++){
            events+="<div class='well well-sm'><a href='meetup.php' style='cursor: pointer; color:black'><i class='fa fa-map-marker' aria-hidden='true'></i><strong> " + records[i][1] + "</strong> with <i class='fa fa-user' aria-hidden='true'></i><strong> "+records[i][4]+"</strong> on <i class='fa fa-calendar' aria-hidden='true'></i><em><small> " + moment(records[i][0]).format('dddd MMMM Do, YYYY') + "</small></em></a></div>";
            eventsCount += 1;
        }
    }
    else{
        events+="<div class='well well-sm'> <em>No upcoming meetups</em></div>";
    }
    events+="</div>";
    $("#eventscount").html(eventsCount);
    $("#reminders").html(events);

}
//----------------------------------------------------------------------------------------------------------------------
// Functionality to display follower uploaded items
function userFollowerUpdates(){
    $.get("../index.php/userfollowerupdates", processUserFollowerUpdates, "json");
}

function processUserFollowerUpdates(records){
    //console.log(records);
    $.get("../index.php/userfollowerupdatesrequests", function(res){
        //console.log(res);
        displayUserFollowerUpdates(records, res);
    },"json");
    
}

function displayUserFollowerUpdates(records, requests){
    var updates="<div class='container-fluid'>", j;
    //alert(records.length);
    var updatesCount = 0;
    if(records.length != requests.length){
        records.forEach(function(el){
            var uploaded = moment(el.uploaddate).startOf('minute').fromNow();
            for(j = 0; j < requests.length; j ++){
                if(el.itemname == requests[j][0]){
                    break;
                }
            }

            if(j == requests.length){
                updates+="<div class='well well-sm'><a onclick=\"viewItem("+el['itemid']+")\" style='cursor: pointer; color:black'> <i class='fa fa-user' aria-hidden='true'></i><strong> "+ el['username'] + "</strong> uploaded <i class='fa fa-gift' aria-hidden='true'></i><strong> " +el['itemname']+ "</strong> <em><small>"+uploaded+"</small></em></a></div>"; 
                updatesCount += 1;
            }
            
        });
    }
    else{
        updates+="<div class='well well-sm'> <em>No follower updates</em></div>";
    }
    updates+="</div>";
    $("#updatescount").html(updatesCount);
    $("#followerupdates").html(updates);
    

}
//---------------------------------------------------------------------------------------------------------------------------
// Function that displays a prompt for a user to comment of why he/she is reporting another trader
function reportTrader(traderId){
    swal({
        title: "Trader Report",
        text: "Please leave a comment about your concern",
        type: "input",
        confirmButtonColor: "#DD6B55",
        showCancelButton: true,
        closeOnConfirm: false,
        animation: "slide-from-top",
        inputPlaceholder: "",
        confirmButtonText: "Send Report"
        },

        function(inputValue){
            
            if (inputValue === false){
                return false;
            }
      
            if (inputValue === "") {
                swal.showInputError("Kindly leave a reason for reporting trader");
                return false
            }
            var traderReport = inputValue.replace(/'/g, "\\'");
            var reportedTrader = {
                "traderid": traderId,
                "traderreport" : traderReport
            };
            /*console.log(deniedRequest);
            $.post("../index.php/reporttrader", reportedTrader, function(res){
                console.log(res); */
                swal({
                    title: "Trader Report Sent!",
                    type: "success",
                    timer: 2000,
                    showConfirmButton: false
                });
            //}, "json"); 
            //swal("Nice!", "You wrote: " + denyReason, "success");
        }
    );
}
//---------------------------------------------------------------------------------------------------------------------------
// Function that displays a prompt for a user to comment of why he/she is reporting an item
function reportItem(itemId){
    swal({
        title: "Item Report",
        text: "Please leave a comment about your concern",
        type: "input",
        confirmButtonColor: "#DD6B55",
        showCancelButton: true,
        closeOnConfirm: false,
        animation: "slide-from-top",
        inputPlaceholder: "",
        confirmButtonText: "Send Report"
        },

        function(inputValue){
            
            if (inputValue === false){
                return false;
            }
      
            if (inputValue === "") {
                swal.showInputError("Kindly leave a reason for reporting item");
                return false
            }
            var itemReport = inputValue.replace(/'/g, "\\'");
            var reportedItem = {
                "itemid": itemId,
                "itemreport" : itemReport
            };
            /*console.log(deniedRequest);
            $.post("../index.php/reporttrader", reportedTrader, function(res){
                console.log(res); */
                swal({
                    title: "Item Report Sent!",
                    type: "success",
                    timer: 2000,
                    showConfirmButton: false
                });
            //}, "json"); 
            //swal("Nice!", "You wrote: " + denyReason, "success");
        }
    );
}
//---------------------------------END-------------------------------------------------
console.log("JunkTrade's JavaScript file was successfully loaded in the page");