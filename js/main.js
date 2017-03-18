"use strict";
console.log("hello I'm connected to the world");

//var base_url = "base.php/api";


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

$(document).ready(function(){
    console.log("All Elements in the Page was successfully loaded, we can begin our application logic");
    //getTrade();
    //getAllItems();
    getUserRequests();
    getDecisions();
    //getUserItems(); 
    //getRequestedMeetUp();
    //getRequestsMeetUp();
    //getUserSavedItems();
    //getUserFollowees();
    //getUserFollowers();
    
    //alert($('#requests > li').length);

});  
// this acts as the main function in Java
setInterval(function(){
    queryUserRequests();
    queryDecisions();
},5000);

var currNotifcations = [], currDecisions = [];
function queryUserRequests(){
    $.get("../index.php/requests", function(res){
        if(JSON.stringify(res) !== JSON.stringify(currNotifcations)){
            console.log("New request");
            currNotifcations = res;
            notifications(res);
        }
    }, "json");  
}

function queryDecisions(){
    $.get("../index.php/decisions", function(res){
        if(JSON.stringify(res) !== JSON.stringify(currDecisions)){
            console.log("New decision");
            currDecisions = res;
            decisions(res);
        }
    }, "json");  
}
 //--------------------------------------------------------------------------------------------------------------------
 var attempts =0;
 // Log in functionality
function login(){
    console.log("Hi");
    var email = $("#email").val();
    var password = $("#password").val();
    //console.log(email + " " + pass);
    var user = {
        "email" : email,
        "password": password
    }

    //console.log(user);
    $.post("../index.php/login", user, function(res){
        //console.log(res);
        if(res != 400){
            //console.log(res);
            attempts=0;
             console.log(attempts);

            swal({ 
                title: "Welcome " + res,
                text: "You have logged in successfully",
                type: "success" 
            },
                function(){
                    window.location.href = 'homepage.php';
            });
            //window.location.href="homepage.php";
            //return false;
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
            else{ swal("Incorrect Login","Please try again","error");
        }

            

            //return false;
        }
    },"json");
    console.log("Logged In");
    return false;
}
//--------------------------------------------------------------------------------------------------------------------
 // Password Reset functionality
function login1(){
    console.log("Hi");
    var email = $("#email").val();
    var securityQuestion = $("#securityquestion").val();
    var sAnswer = $("#sAnswer").val();
    //console.log(email + " " + pass);
    var user = {
        "email" : email,
        "securityquestion" : securityQuestion,
        "sAnswer": sAnswer
    }

    console.log(user);
    $.post("../index.php/login1", user, function(res){
        //console.log(res);
        if(res != 400){
            //console.log(res);
            swal({ 
                title: "Success " + res,
                text: "You have reset your password",
                type: "" 
            },
                function(){
                    window.location.href = 'updatePassword.php';
            });
            //window.location.href="homepage.php";
            //return false;
        }
        else{
            swal("Incorrect Security Answer","Please try again","error")
            //return false;
        }
    },"json");
    console.log("Password Reset");
    return false;
}
//--------------------------------------------------------------------------------------------------------------------
// Registration functionality
function register(){
    //console.log("Hi");
    var username = $("#username").val();
    var firstname = $("#firstname").val();
    var lastname = $("#lastname").val();
    var email = $("#email").val();
    var telephone = $("#telephone").val();
    //var address = $("#address").val();
    var password = $("#password").val();
    //var retypedpassword = $("#retypedpassword").val();
    var securityQuestion = $("#securityquestion").val();
    var securityAnswer = $("#securityanswer").val();
    /*if(password != retypedpassword){
        alert("Password do not match");
        return false;
    } */

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
    console.log(regUser);
    $.post("../index.php/register", regUser, function(res){
        if(res){
            console.log(res);
            swal({ 
                title: "Registration Complete!",
                text: "Proceed to login",
                type: "success" 
            },
                function(){
                    window.location.href = 'login.php';
            });
            //window.location.href="homepage.php";
            //return false;
        }
        else{
            swal("Incorrect Login","Please try again","error")
            //return false;
        }
    },"json");

    return false;
}

//--------------------------------------------------------------------------------------------------------------------
// Registration functionality
function updatePassword(){
    console.log("Hi");
    var password = $("#password").val();
    var retypedpassword = $("#retypedpassword").val();

    var regUser = {
        "password" : password
    };

    console.log(regUser)

    $.post("../index.php/update", regUser, function(res){
        if(res){
            console.log(res);
            swal({ 
                title: "Password Update Complete!",
                text: "Proceed to login",
                type: "success" 
            },
                function(){
                    window.location.href = 'login.php';
            });
        }
        else{
            swal("An error has occured","Please try again","error")
        }
    },"json");

    return false;
}

//--------------------------------------------------------------------------------------------------------------------
//Dsiplay All items available (except user items) on homepage
function sortHomepageItems(sortOrder){
    //alert(value);
    getAllItems(sortOrder);
}

function getAllItems(sort){//alter for slim 
    if(typeof(sort) === 'undefined')
        sort = "mra";
    //alert(sort);
    $.get("../index.php/homepage/"+sort, processAllItems, "json");
}

function processAllItems(records){
    console.log(records);
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
        console.log(requests);
        //$.get("../index.php/requesteritemsstate", function(res){
            //console.log(res);
        
        records.forEach(function(el){
            for(i = 0; i < requests.length; i++){
                if(requests[i]['item'] == el['itemid'] || requests[i]['item2'] == el['itemid']){
                    if(requests[i]['decision'] == true){
                        //console.log("Decision for "+el['itemname'] + ": "+requests[i]['decision']);
                        console.log("Request Accepted for "+el['itemname']);
                        break;
                    }  
                    else {
                        if(requests[i]['requester'] == user){
                            itemdiv += "<div class='col-lg-4 col-md-4 col-sm-6 col-xs-12'>"
                            itemdiv += "<div class='panel panel-warning'>";

                            itemdiv += "<div class='panel-heading text-center'><button style='text-decoration:none; type='button' class='btn btn-link' onclick=\"viewItem("+el.itemid+")\"><strong>"+ el['itemname'] + "</strong> </button><br><small> Views: "+el.views+" </small><br><button style='color:black;text-decoration:none;' type='button' class='btn btn-default btn-xs' onclick=\"viewTraderProfile("+el.userid+")\">" +  "<strong> by "+ el['username'] + "</strong></button></div>"; 

                            itemdiv += "<div class='panel-body'> <div class='text-center'> </div><img style='cursor: pointer; width:100%;' onclick=\"viewItem("+el.itemid+")\" src=\"" + el['picture'] + "\"  class='img-responsive img-thumbnail mx-auto'></div>";

                             if(requests[i]['decision'] == null){
                                itemdiv += "<div class='panel-footer'> <div class='row'><div class='col-xs-12'><button type='button' class='btn btn-danger btn-block active' onclick=\"cancelMadeRequest("+requests[i]['id']+")\" id='requestbtn'><i class='fa fa-ban fa-lg' aria-hidden='true'></i> Cancel Request</button> </div></div></div>";
                                console.log("Request Pending for "+ el['itemname']);
                            }

                            else{
                                itemdiv += "<div class='panel-footer'> <div class='row'><div class='col-xs-12'><button type='button' class='btn btn-primary btn-block active' onclick=\"displayItemsForRequest("+el.itemid+")\" id='requestbtn'><i class='fa fa-cart-plus fa-lg' aria-hidden='true'></i> Make Request</button> </div></div></div>";
                                console.log(el['itemname']+ " is avaialable");
                            }
                    
                            //itemdiv += "<div class='col-lg-6'><button type='button' class='btn btn-info btn-block' onclick=\"viewItem("+el.itemid+")\"><i class='fa fa-eye fa-lg' aria-hidden='true'></i> View more</button> </div> </div></div>";
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
                itemdiv += "<div class='panel-heading text-center'><button style='text-decoration:none; type='button' class='btn btn-link' onclick=\"viewItem("+el.itemid+")\"><strong>"+ el['itemname'] + "</strong></button><br><small> Views: "+el.views+" </small><br><button style='color:black;text-decoration:none;' type='button' class='btn btn-default btn-xs' onclick=\"viewTraderProfile("+el.userid+")\">" +  "<strong> by "+ el['username'] + "</strong></button></div>"; 

                itemdiv += "<div class='panel-body'> <div class='text-center'> </div><img style='cursor: pointer; width:100%;' onclick=\"viewItem("+el.itemid+")\" src=\"" + el['picture'] + "\"  class='img-responsive img-thumbnail mx-auto'></div>";
            

                itemdiv += "<div class='panel-footer'> <div class='row'><div class='col-xs-12 col-xs-offset-0'><button type='button' class='btn btn-primary btn-block active' onclick=\"displayItemsForRequest("+el.itemid+")\" id='requestbtn'><i class='fa fa-cart-plus fa-lg' aria-hidden='true'></i> Make Request</button> </div></div></div>";
                
                //itemdiv += "<div class='col-lg-6'><button type='button' class='btn btn-info btn-block' onclick=\"viewItem("+el.itemid+")\"><i class='fa fa-eye fa-lg' aria-hidden='true'></i> View more</button> </div> </div></div>";
                //itemdiv += "<div class='col-lg-6'> <button type='button' class='btn btn-warning btn-block' onclick=\"addToSavedItems("+el['itemid']+")\" id='requestbtn'><i class='fa fa-bookmark' aria-hidden='true'></i> Save</button></div></div></div>"
                itemdiv += "</div>";
                itemdiv += "</div>";
                console.log(el['itemname']+ " is avaialable");
            }
            /*var requested = false;
            itemdiv += "<div class='panel panel-default'>";
            itemdiv += "<div class='panel-heading'><button style='color:black;text-decoration:none;' type='button' class='btn btn-link' onclick=\"viewTraderProfile("+el.userid+")\">" +  "<strong>"+ el['username'] + "</strong></button></div>"; 

            itemdiv += "<div class='panel-body'> <div class='text-center lead'> <strong>"+  el['itemname'] + "</strong> </div><img style='cursor: pointer;width:100%;' onclick=\"viewItem("+el.itemid+")\" src=\"" + el['picture'] + "\"  class='img-responsive img-thumbnail mx-auto'> </div>";
            
            //If the item displayed on the homepage has been requested by the current user already then they cannot
            // make another request for that item; however, they can cancel that request
            for(i = 0; i < requests.length; i++){
                if(requests[i]['item'] == el['itemid'] && requests[i]['requester'] == user && requests[i]['decision'] == null){
                    itemdiv += "<div class='panel-footer'> <div class='row'><div class='col-lg-6'><button type='button' class='btn btn-danger btn-block' onclick=\"cancelMadeRequest("+requests[i]['id']+")\" id='requestbtn'><i class='fa fa-ban fa-lg' aria-hidden='true'></i> Cancel Request</button> </div>";
                    requested = true;
                    break;
                }
            }

            //If the any of the items displayed do not currently have a request from the current user, then that user will be able to make 
            //a request for that item
            if(requested == false){
                itemdiv += "<div class='panel-footer'> <div class='row'><div class='col-lg-6'><button type='button' class='btn btn-success btn-block' onclick=\"displayItemsForRequest("+el.itemid+")\" id='requestbtn'><i class='fa fa-cart-plus fa-lg' aria-hidden='true'></i> Make Request</button> </div>";
            }
            
            itemdiv += "<div class='col-lg-6'><button type='button' class='btn btn-info btn-block' onclick=\"viewItem("+el.itemid+")\"><i class='fa fa-eye fa-lg' aria-hidden='true'></i> View more</button> </div> </div></div>";
            itemdiv += "</div>"; */
        });

        itemdiv += "</div>";
        $("#itemblock").html(itemdiv);
        //htmlStr += "</tbody></table>";
        //$(sec_id).html(htmlStr);
    //},"json");
    },"json");

    
    
    
}
//--------------------------------------------------------------------------------------------------------------------

//Dsiplay All user items on profile
function getUserItems(){//alter for slim 
    $.get("../index.php/profile", processUserItems, "json");
}

function processUserItems(records){
    console.log(records);
    listUserItems(records)
}

function listUserItems(records){
    var i;
    var sec_id = "#table_secp";
    var htmlStr = $("#table_headingp").html(); //Includes all the table, thead and tbody declarations
    $.get("../index.php/accepteduseritems", function(res){
        console.log(res);
        records.forEach(function(el){
            for(i = 0; i < res.length; i++){
                if(res[i]['item'] == el['itemid'] || res[i]['item2']==el['itemid']){
                    if(res[i]['decision'] == true){
                        htmlStr += "<tr>";
                        htmlStr += "<td style='display:none;'>"+ el['itemid'] +"</td>";
                        htmlStr += "<td><img src=\"" + el['picture'] + "\" width=\"150\" height=\"128\"></td>";
                        htmlStr += "<td>"+ el['itemname'] +"</td>";
                        htmlStr += "<td>"+ el['itemdescription'] +"</td>";
                        
                        htmlStr += "<td><button type='button' class='btn btn-primary disabled'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></td>";
                        htmlStr += "<td><button type='button' class='btn btn-danger disabled'><i class='fa fa-trash' aria-hidden='true'></i></button></td>";
                        htmlStr += "<td>" + el['uploaddate'] + "</td>";
                        htmlStr += "<td> Traded </td>";

                        htmlStr +=" </tr>" ;
                        break;
                    }
                    else{
                        htmlStr += "<tr>";
                        htmlStr += "<td style='display:none;'>"+ el['itemid'] +"</td>";
                        htmlStr += "<td><img src=\"" + el['picture'] + "\" width=\"150\" height=\"128\"></td>";
                        htmlStr += "<td>"+ el['itemname'] +"</td>";
                        htmlStr += "<td>"+ el['itemdescription'] +"</td>";
                    
                        htmlStr += "<td><button type='button' class='btn btn-primary' onclick =\"showUpdateForm("+el.itemid+")\"><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></td>";
                        htmlStr += "<td><button type='button' class='btn btn-danger' onclick=\"deleteItem("+el.itemid+")\"><i class='fa fa-trash' aria-hidden='true'></i></button></td>";
                        htmlStr += "<td>" + el['uploaddate'] + "</td>";
                        htmlStr += "<td> Available </td>";
                        htmlStr +=" </tr>" ;
                        break;
                    }
                    
                }
            }
            if(i==res.length){
                htmlStr += "<tr>";
                htmlStr += "<td style='display:none;'>"+ el['itemid'] +"</td>";
                htmlStr += "<td><img src=\"" + el['picture'] + "\" width=\"150\" height=\"128\"></td>";
                htmlStr += "<td>"+ el['itemname'] +"</td>";
                htmlStr += "<td>"+ el['itemdescription'] +"</td>";
                    
                htmlStr += "<td><button type='button' class='btn btn-primary' onclick =\"showUpdateForm("+el.itemid+")\"><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></td>";
                htmlStr += "<td><button type='button' class='btn btn-danger' onclick=\"deleteItem("+el.itemid+")\"><i class='fa fa-trash' aria-hidden='true'></i></button></td>";
                htmlStr += "<td>" + el['uploaddate'] + "</td>";
                htmlStr += "<td> Available </td>";
                htmlStr +=" </tr>" ;
            }
        });
        htmlStr += "</tbody></table>";
        $(sec_id).html(htmlStr);
    },"json");
    
    //count = $("#mylist li").size();
    
} 

//--------------------------------------------------------------------------------------------------------------------
function viewItem(itemid){
    /*$.get("../index.php/getitem/"+itemid, processItem,"json"); */
    views(itemid); 
    window.location.href = "item.php?item="+itemid;
    return false;
}

function displayItem(records){
    
    // Display item description in modal when "view more" is clicked
    /*$("#description").val(records.itemdescription);   
    $('#itemModal').modal('show'); */
}
//--------------------------------------------------------------------
//Redirects to trader.php and displays the items and other items of the trader clicked
function viewTraderProfile(userid){
    $.get("../index.php/items/"+userid, processTraderProfile, "json");
}

function processTraderProfile(records){
    console.log(records);
    //alert(records[0].userid);
    window.location.href = 'trader.php?trader='+records[0].userid;
    //listProfileItems(records);
    return false;

}
function listProfileItems(records){
    // Display user and their items in a modal
    /*var htmlStr;
       $("#trader").val(records[0].username);
        records.forEach(function(el){
            htmlStr += "<option value='"+el.itemid+"''>" +el.itemname + "</option>";
        });
        $("#items").html(htmlStr);
    $('#profileModal').modal('show'); */

    var itemdiv = "<div>";
    $("#itemP").val(records[0].username);
    console.log(records[0].username);
    records.forEach(function(el){
        itemdiv += "<div class='panel panel-default'>";
        itemdiv += "<div class='panel-heading'>"+  el['itemname'] + "</div>"; 
        itemdiv += "</div>";
    });
    $("#itemblockP").html(itemdiv);
    window.location.href = 'trader.php';
    return false;
}
//---------------------------------------------------------------------------------
//Dsiplay requests for user items in the notification icon


function getUserRequests(){
    $.get("../index.php/requests", notifications, "json");  
}

function notifications(records){
    console.log(records);
    var htmlStr="";
    records.forEach(function(el){
        htmlStr += "<li><a href='notifications.php'>"+ el.username + " is requesting "+ el.itemname + "</a></li>";
        
    });
    $("#requests").html(htmlStr);
    var countR = null;
    countR = $("#requests li").length;
    $("#requestsNotify").html(countR);
    $.get("../index.php/requesteritem", function(res){
        console.log(res);
        displayRequests(records, res);
    });

}

function displayRequests(records, res){
    var key;
    var sec_id = "#table_secr";
    var htmlStr = $("#table_headingr").html(); //Includes all the table, thead and tbody declarations
    var i=0;
    console.log(records);

    records.forEach(function(el){
        var requestId = el['id'];
        
            htmlStr += "<tr>";
            htmlStr += "<td style='display:none;'>"+ el['id'] +"</td>";
            htmlStr += "<td><button style='color:black;text-decoration:none;' type='button' class='btn btn-link' onclick=\"viewTraderProfile("+el.requester+")\">" +  "<strong><i class='fa fa-user' aria-hidden='true'></i>"+  " " + el['username'] + "</strong></button></td>";
            htmlStr += "<td><button type='button' style='color:black;text-decoration:none;' class='btn btn-link' onclick=\"viewItem("+res[i]['itemid']+")\"><strong><i class='fa fa-gift' aria-hidden='true'></i>" + " "+res[i]['itemname']+"<strong></button></td>";
            //htmlStr += "<td></td>";
            htmlStr += "<td><a href='profile.php' class='btn btn-default'><i class='fa fa-gift' aria-hidden='true'></i> "+el['itemname']+"</a></td>";
            
            //htmlStr += "<td><img src=\"" + pic + "\" width=\"150\" height=\"128\"></td>";    
            //htmlStr += "<td><button type='button' class='btn btn-info btn-block' onclick=\"viewRequest("+el.id+")\"><i class='fa fa-eye' aria-hidden='true'></i></button> ";    
            htmlStr += "<td><button type='button' class='btn btn-success' onclick=\"acceptRequest("+el.id+")\"><i class='fa fa-thumbs-up fa-lg' aria-hidden='true'></i></button> ";
            htmlStr += " <button type='button' class='btn btn-danger' onclick=\"denyRequest("+el.id+")\"><i class='fa fa-thumbs-down fa-lg' aria-hidden='true'></i></button></td>";
            htmlStr +=" </tr>" ;
            i++;
        },"json");
    

    htmlStr += "</tbody></table>";
    $(sec_id).html(htmlStr);
}
//--------------------------------------------------------------------------------------------------------------------
//Dsiplay decisions for requests made by user
function getDecisions(){
    $.get("../index.php/decisions", decisions, "json");  
}

function decisions(records){
    console.log(records);
    var htmlStr="";
    records.forEach(function(el){
        if(el.decision == true){
            htmlStr += "<li><a href=trade.php>"+ el.itemname + " request was ACCEPTED" + "</a></li>";
        }
        else{
            htmlStr += "<li><a href=trade.php>"+ el.itemname + " request was DENIED" + "</a></li>";
        }
        
       
    });
     $("#decisions").html(htmlStr);
    var countD = $("#decisions li").length;
    $("#decisionsNotify").html(countD);
    //displayRequests(records);

}
//-------------------------------------------------------------------------------------------
// Display a user trade history
function getTradeHistory(){
    $.get("../index.php/gettradehistory", processTradeHistory, "json");

}

function processTradeHistory(records){
    console.log(records);
    displayTradeHistory(records);
}

function displayTradeHistory(records){
    var sec_id = "#table_sec_tradehistory";
    var htmlStr = $("#table_heading_tradehistory").html(); 
    $.get("../index.php/user", function(user){

        records.forEach(function(el){
            htmlStr +="<tr>";
            htmlStr +="<td>"+el.tradedate+"</td>";
            htmlStr +="<td></td>";
            htmlStr +="<td></td>";
            htmlStr +="<td>"+el.tradelocation+"</td>";
            if(el.requester == user){
                htmlStr +="<td>"+el.requesteefeedbackcomment+"</td>";
                htmlStr +="<td>"+el.requesteefeedbackrating+"</td>";
            }
            else if(el.requestee == user){
                htmlStr +="<td>"+el.requesterfeedbackcomment+"</td>";
                htmlStr +="<td>"+el.requesterfeedbackrating+"</td>";
            }
            
            htmlStr +="</tr>";
        });
        htmlStr += "</tbody></table>";
        $(sec_id).html(htmlStr);
    },"json");
    
}


//--------------------------------------------------------------------
// Add the item clicked to the user's saved items
function addToSavedItems(itemid){
    $.get("../index.php/owner/"+itemid, function(res){
        console.log(res.id);
        var itemOwner = res.id;
        var item= {
            "itemid": itemid,
            "itemowner": itemOwner
        };

        console.log(item);
        $.post("../index.php/saveitem", item, function(res){
            console.log(res);
            if(res){
                //swal("Item Saved!", "You can view item in Saved Items!", "success");
                swal({ 
                    title: "Item Saved!",
                    text: "You can view item in Saved!",
                    type: "success" 
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

function getUserSavedItems(){
    $.get("../index.php/getsaveditems", processUserSavedItems, "json");
}

function processUserSavedItems(records){
    console.log(records);
    var sec_id = "#table_sec_saveditems";
    var htmlStr = $("#table_heading_saveditems").html(); //Includes all the table, thead and tbody declarations
    records.forEach(function(el){
        htmlStr += "<tr>";
        htmlStr += "<td><img src=\"" + el.picture + "\" width=\"150\" height=\"128\"></td>";
        htmlStr += "<td><button type='button' style='color:black;text-decoration:none;' class='btn btn-link' onclick=\"viewItem("+el.itemid+")\"><strong><i class='fa fa-gift' aria-hidden='true'></i>" + " "+el['itemname']+"<strong></button></td>";
        htmlStr += "<td><button style='color:black;text-decoration:none;' type='button' class='btn btn-link' onclick=\"viewTraderProfile("+el.userid+")\">" +  "<strong><i class='fa fa-user' aria-hidden='true'></i>"+  " " + el['username'] + "</strong></button></td>";
        htmlStr += "<td>"+ el['saveddate'] +"</td>";      
        htmlStr += "<td><button type='button' class='btn btn-danger btn-block' onclick=\"removeSavedItem("+el.savedid+")\"><i class='fa fa-times' aria-hidden='true'></i> Unsave</button></td>";
        htmlStr +=" </tr>" ;
    });

    htmlStr += "</tbody></table>";
    $(sec_id).html(htmlStr);
    return false;
}


function removeSavedItem(savedId){
    var savedItem = {
        "savedid": savedId
    };
    $.post("../index.php/removedsaveditem",savedItem, function(res){
        console.log(res);
        //swal("Item removed!", "You can save the item again", "error");
        swal({ 
                title: "Item removed!",
                text: "You can save the item again!",
                type: "error" 
            },
                function(){
                    if(window.location.href.indexOf("/item.php?") > -1)
                        window.location.reload();
                    else
                        getUserSavedItems();
                }
            );
        //getUserSavedItems();
        //window.location.reload();
        return false;
    }, "json");
    return false;
}
//--------------------------------------------------------------------------------------------------------------------
// Adds the trader clicked to the user's followers
function followTrader(userid){
    //alert(userid);
    var followee = {
        "followee" : userid
    }

    $.post("../index.php/follow",followee, function(res){
        console.log(res);
        if(res){
            swal({ 
                title: "Trader Followed!",
                text: "You can view followed trader in People!",
                type: "success" 
            },
                function(){
                    window.location.reload();
            });
            //swal("Trader Followed!", "You can view followed trader in People!", "success");
            
        }
        else{
            swal("Trader Not Followed!", "Error!", "error")
        }

    },"json");

    //swal("Trader Followed!", "You can view followed trader in People!", "success");
    
}

function unfollowTrader(userid){
        var followee = {
            "followee" : userid
        };

        $.post("../index.php/unfollow", followee, function(res){
            //console.log(res);
            //swal("Trader Unfollowed!", "You can follow them again!", "error");
            swal({ 
                title: "Trader Unfollowed!",
                text: "You can follow them again!",
                type: "error" 
            },
                function(){
                    if(window.location.href.indexOf("/trader.php") > -1)
                        window.location.reload();
                    else
                        getUserFollowees();
                }
            );
        }, "json");    
}


function getUserFollowees(){
    $.get("../index.php/followees", processUserFollowees, "json");

}

function processUserFollowees(records){
    console.log(records);
    var sec_id = "#table_sec_followees";
    var htmlStr = $("#table_heading_followees").html(); //Includes all the table, thead and tbody declarations
    records.forEach(function(el){
        htmlStr += "<tr>";
        htmlStr += "<td><button style='color:black;text-decoration:none;' type='button' class='btn btn-link' onclick=\"viewTraderProfile("+el.followee+")\">" +  "<strong><i class='fa fa-user' aria-hidden='true'></i>"+  " " + el['username'] + "</strong></button></td>";
        htmlStr += "<td>"+ el['followdate'] +"</td>";      
        htmlStr += "<td><button type='button' class='btn btn-danger btn-block' onclick=\"unfollowTrader("+el.followee+")\"><i class='fa fa-times' aria-hidden='true'></i> Unfollow</button></td>";
        htmlStr +=" </tr>" ;
    });

    htmlStr += "</tbody></table>";
    $(sec_id).html(htmlStr);
    return false;
}



function getUserFollowers(){
    $.get("../index.php/followers", processUserFollowers, "json");

}

function processUserFollowers(records){
    console.log(records);
    var sec_id = "#table_sec_followers";
    var htmlStr = $("#table_heading_followers").html(); //Includes all the table, thead and tbody declarations
    records.forEach(function(el){
        htmlStr += "<tr>";
        htmlStr += "<td><button style='color:black;text-decoration:none;' type='button' class='btn btn-link' onclick=\"viewTraderProfile("+el.follower+")\">" +  "<strong><i class='fa fa-user' aria-hidden='true'></i>"+ " "+el['username'] + "</strong></button></td>";
        htmlStr += "<td>"+ el['followdate'] +"</td>";      
        htmlStr +=" </tr>" ;
    });

    htmlStr += "</tbody></table>";
    $(sec_id).html(htmlStr);
    return false;
}
//--------------------------------------------------------------------------------------------------------------------


/*function displayDecisions(records){
    var key;
    var sec_id = "#table_secr";
    var htmlStr = $("#table_headingr").html(); //Includes all the table, thead and tbody declarations
    var pic;
    records.forEach(function(el){
        htmlStr += "<tr>";
        htmlStr += "<td style='display:none;'>"+ el['id'] +"</td>";
        htmlStr += "<td>"+ el['username'] +"</td>";
        htmlStr += "<td>"+ el['itemname'] +"</td>";

        $.get("../index.php/itemimage/"+el['item'], function(res){
            //alert(res.picture);
            htmlStr += "<td><img src=\"" + res.picture + "\" width=\"150\" height=\"128\"></td>";
        }, "json");

        htmlStr += "<td><img src=\"" + pic + "\" width=\"150\" height=\"128\"></td>";        
        htmlStr += "<td><button type='button' class='btn btn-success' onclick=\"acceptRequest("+el.id+")\"><i class='fa fa-check-square-o' aria-hidden='true'></i></button> ";
        htmlStr += "<button type='button' class='btn btn-warning' onclick=\"denyRequest("+el.id+")\"><i class='fa fa-ban' aria-hidden='true'></i></button></td>";
        htmlStr +=" </tr>" ;
    });

    htmlStr += "</tbody></table>";
    $(sec_id).html(htmlStr);
} */

//--------------------------------------------------------------------------------------------------------------------

//Dsiplay decisions for requests made by user
//Dsiplay All user items on profile
function getTrade(){//alter for slim 
    $.get("../index.php/trade", processUserTrade, "json");
}

function processUserTrade(records){
    console.log(records);
    $.get("../index.php/outgoingrequestitems", function(res){
        console.log(res);
        listUserTrade(records, res);
    }, "json");
    //showRequestData(records);
}

function listUserTrade(records, res){
    var i=0;
    var sec_id = "#table_sect";
    var htmlStr = $("#table_headingt").html(); //Includes all the table, thead and tbody declarations

    records.forEach(function(el){
        htmlStr += "<tr>";
        htmlStr += "<td><button style='color:black;text-decoration:none;' type='button' class='btn btn-link' onclick=\"viewTraderProfile("+el.requestee+")\">" +  "<strong><i class='fa fa-user' aria-hidden='true'></i>"+  " " + el['username'] + "</strong></button></td>";
        /*htmlStr += "<td><button type='button' style='color:black;text-decoration:none;' class='btn btn-link' onclick=\"viewItem("+el.itemid+")\"><strong><i class='fa fa-gift' aria-hidden='true'></i>" + " "+el['itemname']+"<strong></button></td>";
        htmlStr += "<td><i class='fa fa-gift' aria-hidden='true'></i>" + res[i]['itemname']+"</td>";
        htmlStr += "<td>" + el['timerequested'] + "</td>"; */
        if(el['decision'] == null){
            htmlStr += "<td><button type='button' style='color:black;text-decoration:none;' class='btn btn-link' onclick=\"viewItem("+el.itemid+")\"><strong><i class='fa fa-gift' aria-hidden='true'></i> " + el['itemname']+"<strong></button></td>";
            htmlStr += "<td><a href='profile.php' class='btn btn-default'><i class='fa fa-gift' aria-hidden='true'></i> " + res[i]['itemname']+"</a></td>";
            htmlStr += "<td>" + el['timerequested'] + "</td>";
            htmlStr += "<td> Pending <i class='fa fa-spinner fa-pulse fa-lg fa-fw'></i><span class='sr-only'>Loading...</span></td>";
            //htmlStr += "<td> <i class='fa fa-spinner fa-pulse fa-2x fa-fw'></i><span class='sr-only'>Loading...</span></td>";
            htmlStr += "<td><div><button type='button' class='btn btn-danger btn-block active' onclick=\"cancelMadeRequest("+el['id']+")\" id='requestbtn'><i class='fa fa-ban fa-lg' aria-hidden='true'></i> Cancel Request</button> </div></td>";
        }
        else if(el['decision'] == true){
            htmlStr += "<td><button type='button' style='color:black;text-decoration:none;' class='btn btn-link disabled'><strong><i class='fa fa-gift' aria-hidden='true'></i>" + " "+el['itemname']+"<strong></button></td>";
            htmlStr += "<td><a disabled class='btn btn-default'><i class='fa fa-gift' aria-hidden='true'></i> " + res[i]['itemname']+"</a></td>";
            htmlStr += "<td>" + el['timerequested'] + "</td>";
            htmlStr += "<td> Accepted <i class='fa fa-check fa-lg' aria-hidden='true'></i></td>";
            //htmlStr += "<td><i class='fa fa-check fa-2x' aria-hidden='true'></i></td>";
            htmlStr += "<td><button type='button' class='btn btn-success btn-block' onclick=\"meetUp("+el.rid+")\"><i class='fa fa-map-marker fa-lg' aria-hidden='true'></i> View Meetup</button></td>";
        }
        else{
            htmlStr += "<td><button type='button' style='color:black;text-decoration:none;' class='btn btn-link disabled'><strong><i class='fa fa-gift' aria-hidden='true'></i>" + " "+el['itemname']+"<strong></button></td>";
            htmlStr += "<td><a href='profile.php' class='btn btn-default'><i class='fa fa-gift' aria-hidden='true'></i> " + res[i]['itemname']+"</a></td>";
            htmlStr += "<td>" + el['timerequested'] + "</td>";
            htmlStr += "<td> Denied <i class='fa fa-ban fa-lg' aria-hidden='true'></i></td>";
            htmlStr += "<td> </td>";
        }

        htmlStr +=" </tr>" ;
        i++;
    });
    //count = $("#mylist li").size();
    htmlStr += "</tbody></table>";
    $(sec_id).html(htmlStr);
} 

function meetUp(requestid){
    //swal("Working!", "", "success");
    window.location.href = "meetup.php";
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
//----------------------------------------------------------------------------------------------------------------------

// Add item image, name and description to database
function addItem(){
    var image = $("#image").val();
    var itemName = $("#itemname").val();
    var itemDescription = $("#itemdescription").val();
    //alert(image);
    var slash = image.indexOf("\\",5);
    image = image.substring(slash+1, image.length);
    //alert(image);
    var item = {
        "image" : image,
        "itemname" : itemName,
        "itemdescription" : itemDescription
    };

    console.log(item);
    $.post("../index.php/additem", item, function(res){
        if (res.id && res.id > 0)swal("Uploaded", "Item Saved", "success");
        else swal("Upload Error", "Unable to save item", "error");
        hideForm();
        getUserItems();
        clearFields();
    },"json");
    return false;
}

function clearFields(){
    $("#image").val(""); 
    $("#itemname").val("");
    $("#itemdescription").val("");
}

//--------------------------------------------------------------------------------------------------------------------

// Update existing item data
function updateItem(){
    
    return false;
}

//--------------------------------------------------------------------------------------------------------------------
// Inserts a records to the database when a user makes a request to that item
function makeRequest(itemid){
    $.get("../index.php/user", function(res){
        console.log(res);
        $.get("../index.php/items/"+res, function(res){
            //console.log(res);
            //displayItemsForRequest(res);
        }, "json");
    }, "json");
    $.get("../index.php/request/"+itemid, function(res){
        if (res.id && res.id > 0)
            swal("Request Made!", "", "success");
        else 
            swal("Record", "Unable to save record", "error");
    }, "json");
}

function displayItemsForRequest(itemid){
    $.get("../index.php/user", function(res){
        var user = res;
        //console.log(user);
        $.get("../index.php/items/"+user, function(res){
            console.log(res);
            displayInModal(res, itemid);

        }, "json")
    }, "json");
    
}

function displayInModal(records, itemid){
    if ($("#requesteritem").length > 0){ 
        $.get("../index.php/accepteduseritems", function(res){
            console.log(res);
        
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

    $("#requestModal").modal();
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

    console.log(request);
    sweetAlert(
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
                    console.log(res);
                    if (res.id && res.id > 0){
                        //swal("Request Made!", "Trader will be notified", "success");
                        swal({ 
                            title: "Request Made!",
                            text: "Trader will be notified!",
                            type: "success" 
                            },
                            function(){
                                if(window.location.href.indexOf("/item.php?") > -1 || window.location.href.indexOf("/trader.php") > -1){
                                    window.location.reload();
                                }
                                else{
                                    getAllItems(); 
                                }
                            }
                        );
                    }
                    
                },"json"); 
            } 
            else {
                swal("Request Cancelled!", "You can make another request", "error");
            }
        }
    );
    
    $('#requestModal').modal('hide');
    return false;
}

function cancelRequest(){
    $('#requestModal').modal('hide');
    swal("Request Cancelled!", "You can make another request", "error");   
    return false;
}
//--------------------------------------------------------------------------------------------------------------------
// Deletes a user item from the list
function deleteItem(itemid){
    
    $.get("../index.php/requeststatus/"+itemid, function(res){
        //if(res.pending != 0)
        //console.log("Pending requests: " + res.pending);
        console.log(res);
        //var count = parseInt(res[0][0]) + parseInt(res[1][0]);
        //console.log("Pending requests: " + count);
    },"json");
    swal({
            title: "Delete Item?",
            text: "You will not be able to undo this operation!",
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
                    console.log("Pending requests: " + count);
                    if(count != 0){
                        swal("Requests Pending: "+count, "Cannot delete item!", "error")
                    }
                    else{
                        $.get("../index.php/deleteitem/"+itemid, function(res){
                            swal("Item Deleted!", "Your item has been deleted!", "success");
                            getUserItems(); 
                        }, "json"); 
                    }  
                }, "json");
            } 
            else {
                swal("Cancelled", "Your item is safe", "error");
            }
        }
    );
    
}
//-------------------------------------------------------------------------------------------------------------------
function views(itemid){
    $.get("../index.php/itemimage/"+itemid, function(res){
        console.log(res);
        var url = res.picture;
        console.log(url);
        //$('.imagepreview').attr('src', url);
        //$('#imagemodal').modal('show'); 
    }, "json");
    
    $.get("../index.php/viewitem/"+itemid, function(res){
                //swal("Viewed!", "You view the item.", "success");
                console.log(res);
    }, "json");

    getAllItems();
    //getData();
}
//--------------------------------------------------------------------------------------------------------------------

//---------------------------------------------------------------
function viewRequest(requestId){
    console.log(requestId);
    $.get("../index.php/requestdetails/"+requestId, function(res){
            console.log(res);
            
            $("#viewrequestform #requester").val(res.username);
            $("#viewrequestform #requesteritem").val(res.itemname);
            $('#viewrequestform #imagepreview').attr('src', res.picture);
            $("#requestModalP").modal();
        }, "json");
}

//--------------------------------------------------------------------------------------------------------------------
function acceptRequest(requestId){
    $("#meetupform #requestid").val(requestId);

    $.get("../index.php/requester/"+requestId, function(res){
        console.log(res);

        $("#meetupform #requester").val(res.username);
        $("#meetupform #requesteritemid").val(res.itemid);
        $("#meetupform #requesteritem").val(res.itemname);
        $("#meetupform #requestercontact").val(res.requestercontact);

        $.get("../index.php/requestee/"+requestId, function(res){
            console.log(res);
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

    sweetAlert({
        title: "Accept Request and Send Arrangement?",
        //text: "You will not be able to undo this operation!",
        type: "info",
        showCancelButton: true,
        confirmButtonColor: "#5cd65c",
        confirmButtonText: "Accept",
        cancelButtonText: "Cancel",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm){
        if (isConfirm) {
            $.post("../index.php/acceptrequest", request, function(res){
                console.log(res);
                arrangement();
                swal("Request Accepted and Arrangment Sent!", "The user will be notified", "success");
                
                getUserRequests();
                return false;
            }, "json");
            
        } else {
            swal("Cancelled", "Request and Arrangement still Pending", "error");
        }
    });
    return false;
    
}

//------------------------------------------------------------------------------------------------
function cancelArrangement(){
    sweetAlert("Cancelled", "Request and Arrangement still Pending", "error");
    return false;
}
//---------------------------------------------------------------------------------------------
function arrangement(){
    var requestId = $("#meetupform #requestid").val();
    var tradeDate = $("#meetupform #tradedate").val();
    var tradeLocation = $("#meetupform #tradelocation").val();
    var requesteeContact = $("#meetupform #requesteecontact").val();
    var requesterContact = $("#meetupform #requestercontact").val();

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

//--------------------------------------------------------------------------------------------------------------------
function denyRequest(requestId){
    swal({
        title: "Deny Request?",
        //text: "You will not be able to undo this operation!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Deny",
        cancelButtonText: "Cancel",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm){
        
        if (isConfirm) {
            $.get("../index.php/denyrequest/"+requestId, function(res){
                swal("Denied!", "The trader will be notified of your decision", "success");
                 getUserRequests();
            }, "json");
           
        } else {
            swal("Cancelled", "The item request is still pending", "error");
        }
    });
}


function cancelMadeRequest(requestId){
    swal({
        title: "Cancel Request?",
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
            console.log(request);
            $.post("../index.php/cancelrequest", request, function(res){
                //swal("Request Cancelled!", "The owner will no longer see your request", "success");
                swal({ 
                    title: "Request Cancelled!",
                    text: "Trader will be notified!",
                    type: "success" 
                    },
                    function(){
                        if(window.location.href.indexOf("/item.php?") > -1 || window.location.href.indexOf("/trader.php") > -1 || window.location.href.indexOf("/trade.php") > -1){
                            window.location.reload();
                        }
                        else{
                            getAllItems();
                        }
                    }
                );
                
            }, "json");
            
        } else {
            swal("Cancelled", "Your request is still pending", "error");
        }
    });
}
//--------------------------------------------------------------------------------------------------------------------
//


//-------------------------------------------------------------------------//
// Gets the information for the items that the user requested
function getRequestedMeetUp(){
    $.get("../index.php/requestedmeetuprequestee", function(res1){
        console.log(res1);
        $.get("../index.php/requestedmeetuprequester",function(res2){
            console.log(res2);
            processRequestedMeetUp(res1,res2);
        },"json");
    },"json");

} 

function processRequestedMeetUp(records, records2){
    console.log(records);
    var sec_id = "#table_sec_requested";
    var htmlStr = $("#table_heading_requested").html(); //Includes all the table, thead and tbody declarations
    var i = 0, size = records2.length -1;
    //console.log(size);
    //console.log(records[1][0]);
    records.forEach(function(el){
        // do get request with request id to get my item and contact
        htmlStr += "<tr>";
        htmlStr += "<td><button style='color:black;text-decoration:none;' type='button' class='btn btn-link' onclick=\"viewTraderProfile("+el.requestee+")\">" +  "<strong><i class='fa fa-user' aria-hidden='true'></i>"+  " " + el['username'] + "</strong></button></td>"
        htmlStr += "<td><i class='fa fa-phone' aria-hidden='true'></i> "+el['requesteecontact']+"</td>"
        htmlStr += "<td><button type='button' style='color:black;text-decoration:none;' class='btn btn-link' onclick=\"viewItem("+el['item']+")\"><strong><i class='fa fa-gift' aria-hidden='true'></i>" + " "+el['itemname']+"<strong></button></td>"
        htmlStr += "<td><i class='fa fa-gift' aria-hidden='true'></i> "+records2[i]['itemname']+"</td>";
        htmlStr += "<td> <i class='fa fa-calendar' aria-hidden='true'></i> " + el['tradedate'] + "</td>";
        htmlStr += "<td><i class='fa fa-map-marker' aria-hidden='true'></i> " + el['tradelocation'] + "</td>";
        //htmlStr += "<td><button type='button' class='btn btn-info' onclick =\"suggestLocation("+el.tradeid+")\"><i class='fa fa-edit' aria-hidden='true'></i></button></td>";
        htmlStr += "<td><button type='button' class='btn btn-default' onclick =\"chat("+el.requester+")\"><i class='fa fa-comments' aria-hidden='true'></i></button></td>";
        htmlStr += "<td><button type='button' class='btn btn-info' onclick =\"showRequesterFeedbackForm("+el.tradeid+")\"><i class='fa fa-commenting-o' aria-hidden='true'></i></button></td>";
        htmlStr +=" </tr>" ;
        i++;
    });
    //count = $("#mylist li").size();
    htmlStr += "</tbody></table>";
    $(sec_id).html(htmlStr); 
}


//---------------------------------------------------------------------------------//
// Gets requests for the requests made for the users' items

function getRequestsMeetUp(){
     $.get("../index.php/requestsmeetuprequestee", function(res1){
        console.log(res1);
        $.get("../index.php/requestsmeetuprequester",function(res2){
            console.log(res2);
            processRequestsMeetUp(res1, res2);
        },"json");
    },"json");
}

function processRequestsMeetUp(records, records2){
    console.log(records);
    var sec_id = "#table_sec_requests";
    var htmlStr = $("#table_heading_requests").html(); //Includes all the table, thead and tbody declarations
    var i = 0;

    records2.forEach(function(el){
        // do get request with request id to get my item and contact
        htmlStr += "<tr class='text-center'>";
        htmlStr += "<td><button style='color:black;text-decoration:none;' type='button' class='btn btn-link' onclick=\"viewTraderProfile("+el.requester+")\">" +  "<strong><i class='fa fa-user' aria-hidden='true'></i>"+  " " + el['username'] + "</strong></button></td>"
        htmlStr += "<td><i class='fa fa-phone' aria-hidden='true'></i> "+el['requestercontact']+"</td>"
        htmlStr += "<td><button type='button' style='color:black;text-decoration:none;' class='btn btn-link' onclick=\"viewItem("+el['item2']+")\"><strong><i class='fa fa-gift' aria-hidden='true'></i>" + " "+el['itemname']+"<strong></button></td>"
        htmlStr += "<td><i class='fa fa-gift' aria-hidden='true'></i>  "+records[i]['itemname']+"</td>";
        htmlStr += "<td><i class='fa fa-calendar' aria-hidden='true'></i>  " + el['tradedate'] + "</td>";
        htmlStr += "<td><i class='fa fa-map-marker' aria-hidden='true'></i>  " + el['tradelocation'] + "</td>";
        htmlStr += "<td><button type='button' class='btn btn-default' onclick =\"chat("+el.requester+")\"><i class='fa fa-comments' aria-hidden='true'></i></button></td>";
        htmlStr += "<td><button type='button' class='btn btn-info' onclick =\"showRequesteeFeedbackForm("+el.tradeid+")\"><i class='fa fa-commenting-o' aria-hidden='true'></i></button></td>";
        htmlStr +="</tr>" ;
        i++;
    });
    //count = $("#mylist li").size();
    htmlStr += "</tbody></table>";
    $(sec_id).html(htmlStr); 
}

//------------------------------------------------------------------------------//
// Decides on the location given by the requestee
function locationDecision(tradeid){
    swal({
            title: "Accept Location?",
            text: tradeid,
            type: "warning",
            animation: "slide-from-top",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, accept it!",
            cancelButtonText: "No, deny it!",
            closeOnConfirm: false,
            closeOnCancel: false,

        },
        function(isConfirm){
            if (isConfirm) {
                swal("Accepted!", "You have confirmed meetup location!", "success");
            } 
            else {
                swal("Denied!", "Location rejected!", "error");
            }
        }
    );
}

//------------------------------------------------------------------------------//
function suggestLocation(tradeid){
    /*swal({
          title: "Suggest a meet up location",
          text: "Write something interesting:",
          type: "input",
          showCancelButton: true,
          closeOnConfirm: false,
          animation: "slide-from-top",
          inputPlaceholder: "E.g. DAAGA"
        },
        function(inputValue){
          if (inputValue === false) return false;
          
          if (inputValue === "") {
            swal.showInputError("You need to write something!");
            return false
          }
          
          swal("Nice!", "Your suggested locationn is: " + inputValue, "success");
        }
    ); */
}


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

    console.log(feedback);
    $.post("../index.php/requesterfeedback", feedback, function(res){
        swal("Feedback saved!", "Thank you for your rating and comment", "success");
        getRequestedMeetUp();
    }, "json");
    return false;
}



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
    
    console.log(feedback);
    $.post("../index.php/requesteefeedback", feedback, function(res){
        swal("Feedback saved!", "Thank you for your rating and comment", "success");
        getRequestsMeetUp();
    }, "json");
    return false;
}

function cancelFeedback(){
    swal("Cancelled!", "Feedback not saved!", "error");
}
//------------------------------------------------------------------------------------------------
function logout(){
    swal({
        title: "Proceed to Logout?",
        //text: "You will not be able to undo this operation!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Logout",
        cancelButtonText: "Stay Logged In",
        closeOnConfirm: false,
        closeOnCancel: false
    },
    function(isConfirm){
        
        if (isConfirm) {
            swal({ 
                title: "Goodbye!",
                text: "See you next time :)!",
                type: "error" 
            },
                function(){
                    window.location.href = 'login.php';
                }
            );

        } else {
            swal("Still Logged In", "Continue Trading!", "success");
        }
    });
    return false;
}
//------------------------------------------------------------------------------------------------------
function chat(userid){
    swal({
          title: "Let's Chat",
          text: "Send Message: ",
          type: "input",
          showCancelButton: true,
          closeOnConfirm: false,
          animation: "slide-from-top"
        },
        function(inputValue){
          if (inputValue === false) return false;
          
          if (inputValue === "") {
            swal.showInputError("You need to write something!");
            return false
          }
          
          swal("Nice!", "Your message: '" + inputValue + "' was sent", "success");
        }
    );
}
//-------------------------------------------------------------------------------------------------------
function userMeetUp(){
    $.get("../index.php/usermeetup",processUserMeetUp,"json");

}

function processUserMeetUp(records){
    console.log(records);
    displayUserMeetUp(records);
}

function displayUserMeetUp(records){
    var events="<div class='container-fluid'>";
    //console.log(records.length);
    if(records.length != 0){
        console.log(records.length);
        //records.forEach(function(el){
            for(var i = 0; i < records.length; i++){
                events+="<div class='well well-sm'><a href='meetup.php' style='cursor: pointer; color:black'><i class='fa fa-calendar' aria-hidden='true'></i> " + records[i][0] + " at <i class='fa fa-map-marker' aria-hidden='true'></i> " + records[i][1] + "</a></div>";
            }
            
        //});
    
    }
    else{
        events+="<div class='well well-sm'> <em>No upcoming meetups</em></div>";
    }
    events+="</div>"
    $("#reminders").html(events);

}
//---------------------------------------------------------------------------------------------------------
function userFollowerUpdates(){
    $.get("../index.php/userfollowerupdates", processUserFollowerUpdates, "json");
}

function processUserFollowerUpdates(records){
    console.log(records);
    displayUserFollowerUpdates(records);
}

function displayUserFollowerUpdates(records){
    var updates="<div class='container-fluid'>";
    //alert(records.length);
    if(records.length != 0){
        records.forEach(function(el){
            updates+="<div class='well well-sm'><a onclick=\"viewItem("+el['itemid']+")\" style='cursor: pointer; color:black'> <i class='fa fa-user' aria-hidden='true'></i>"+  " " + el['username'] + " uploaded <i class='fa fa-gift' aria-hidden='true'></i>" + " "+el['itemname']+"</a></div>";
        });
    }
    else{
        updates+="<div class='well well-sm'> <em>No follower updates</em></div>";
    }
    updates+="</div>"
    $("#followerupdates").html(updates);

}
//--------------------------------------------------------------------------------------------





//---------------------------------END-------------------------------------------------
console.log("JavaScript file was successfully loaded in the page");