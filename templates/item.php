<?php
include "../lib.php";
include "base.php";

if(isset($_GET['item'])){
    $itemid = $_GET['item'];
	//var_dump($itemid);

	$itemDetails = getItem($itemid);
    $itemId = $itemDetails['itemid'];
	$username = getUsername($itemDetails['userid']);
    $savedItem = checkItemSaved($itemId);
    $itemRequest = getItemRequestForCurrentUser($itemId);
    $itemImages = getItemImages($itemid);
    //var_dump($savedItem);
	//var_dump($username);
    //var_dump($itemRequest);
    //print_r($itemImages);
    $itemDetails['uploaddate'] = date("l F jS, Y", strtotime($itemDetails['uploaddate']));

}
?>

<div class ="container-fluid">
  <div class="row">
  <?php
    echo "<div class='col-lg-1 col-md-1 col-sm-12 col-xs-12'>
            <div id='slider-thumbs'>
                <ul class='hide-bullets'>
                    <li>
                        <a class='thumbnail col-lg-12 col-md-12 col-sm-4 col-xs-4' id='carousel-selector-0'>
                            <img src=\"" . $itemImages['picture'] . "\">
                        </a>
                    </li>
                    <li>
                        <a class='thumbnail col-lg-12 col-md-12 col-sm-4 col-xs-4' id='carousel-selector-1'>
                            <img src=\"" . $itemImages['picture2'] . "\">
                        </a>
                    </li>

                    <li>
                        <a class='thumbnail col-lg-12 col-md-12 col-sm-4 col-xs-4' id='carousel-selector-2'>
                            <img src=\"" . $itemImages['picture3'] . "\">
                        </a>
                    </li>
                </ul>
           </div>
        </div>";

    echo "<div class='col-lg-5 col-md-5 col-sm-12 col-xs-12' id='slider'>
            <div class='row'>
                <div class='col-sm-12' id='carousel-bounding-box'>
                    <div class='carousel slide' id='myCarousel'>
                        <div class='carousel-inner'>
                            <div class='active item' data-slide-number='0'>
                                <a href ='#' onclick=\"viewItemImage('".$itemImages['picture']."')\"><img src=\"" . $itemImages['picture'] . "\"  style='width:100%;' class='img-responsive img-thumbnail mx-auto'> </a>
                            </div>
                            <div class='item' data-slide-number='1'>           
                                <a href ='#' onclick=\"viewItemImage('".$itemImages['picture2']."')\"><img src=\"" . $itemImages['picture2'] . "\" style='width:100%;' class='img-responsive img-thumbnail mx-auto'></a>
                            </div>
                            <div class='item' data-slide-number='2'>        
                                <a href ='#' onclick=\"viewItemImage('".$itemImages['picture3']."')\"><img src=\"" . $itemImages['picture3'] . "\" style='width:100%;' class='img-responsive img-thumbnail mx-auto'></a>
                            </div>
                        </div>
                        <!-- Carousel nav -->
                        <a class='left carousel-control' href='#myCarousel' role='button' data-slide='prev'>
                            <span class='glyphicon glyphicon-chevron-left'></span>
                        </a>
                        <a class='right carousel-control' href='#myCarousel' role='button' data-slide='next'>
                            <span class='glyphicon glyphicon-chevron-right'></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>";

  	echo "<div class='col-lg-4 col-md-4 col-sm-12 col-xs-12' style='border:1px solid #cecece;'>
        <h1><u>" . $itemDetails['itemname'] . "</u></h1>
  			<strong> Owned by </strong> <button type='button' class='btn btn-default' onclick=\"viewTraderProfile(".$itemDetails['userid'].")\"><i class='fa fa-user' aria-hidden='true'></i> " . $username['username'] . "</button> 
        <p> <strong> Uploaded on </strong><i class='fa fa-calendar' aria-hidden='true'></i> " . $itemDetails['uploaddate'] . "</p>
  			<h3> <u> Description </u> </h3>" . $itemDetails['itemdescription'] . "</div>";

    echo "<div class='col-lg-2 col-md-2 col-sm-12 col-xs-12'>";
    //var_dump($itemRequest['decision']);
    //var_dump($itemRequest);
    if($itemRequest == null){
        echo "<button type='button' class='btn btn-primary btn-block' onclick=\"displayItemsForRequest(".$itemDetails['itemid'].")\" id='requestbtn'><i class='fa fa-cart-plus fa-lg' aria-hidden='true'></i> Make Request</button>";
        //echo "No request!";
    }
    else{
        if($itemRequest['decision'] == true){
            echo "<button type='button' class='btn btn-default btn-block disabled'><i class='fa fa-check fa-lg' aria-hidden='true'></i> Accepted</button>";
        }
        else if( $itemRequest['decision'] == null){
            echo "<button type='button' class='btn btn-danger btn-block' onclick=\"cancelMadeRequest(".$itemRequest['id'].")\" id='requestbtn'><i class='fa fa-ban fa-lg' aria-hidden='true'></i> Cancel Request</button>";
        }
        else{
            
            echo "<button type='button' class='btn btn-primary btn-block' onclick=\"displayItemsForRequest(".$itemDetails['itemid'].")\" id='requestbtn'><i class='fa fa-cart-plus fa-lg' aria-hidden='true'></i> Make Request</button>";
        }
        
        //echo "Request pending!";
    }
    
    if($savedItem == null || $savedItem['savedindicator'] == false){
      echo "<button type='button' class='btn btn-primary btn-block' onclick=\"addToSavedItems(".$itemDetails['itemid'].")\" id='requestbtn' data-toggle='tooltip' title='Click to Save Item' data-placement='bottom'><i class='fa fa-bookmark fa-lg' aria-hidden='true'></i> Save</button>";
    }
    else{
      echo "<button type='button' class='btn btn-success btn-block' onclick=\"removeSavedItem(".$savedItem['savedid'].")\" id='requestbtn' data-toggle='tooltip' title='Click to Unsave Item' data-placement='bottom'><i class='fa fa-check' aria-hidden='true'></i> Saved</button>";
    }
    echo "<button type='button' class='btn btn-info btn-block' onclick=\"reportItem(".$itemDetails['itemid'].")\" data-toggle='tooltip' title='Click to Report Item' data-placement='bottom'><i class='fa fa-commenting' aria-hidden='true'></i> Report Item</button>";
    echo "</div>";

  ?>
  </div>
</div>


<script>
$(document).ready(function(){

  $('#myCarousel').carousel({
                interval: 10000
        });
 
        //Handles the carousel thumbnails
        $('[id^=carousel-selector-]').click(function () {
        var id_selector = $(this).attr("id");
        try {
            var id = /-(\d+)$/.exec(id_selector)[1];
            console.log(id_selector, id);
            jQuery('#myCarousel').carousel(parseInt(id));
        } catch (e) {
            console.log('Regex failed!', e);
        }
    });
        // When the carousel slides, auto update the text
        $('#myCarousel').on('slid.bs.carousel', function (e) {
                 var id = $('.item.active').data('slide-number');
                $('#carousel-text').html($('#slide-content-'+id).html());
        });
});

//var itemId = <?php echo $_GET['item']; ?>;
var itemId = <?php echo json_encode($_GET['item']) ?>;
var tradedStatus = <?php echo json_encode(getItemTradedStatus($_GET['item'])) ?>;
console.log(tradedStatus);
if(tradedStatus != null){
    tradedResponse();
}
//console.log(<?php echo json_encode($_GET['item']) ?>);

setInterval(function(){
    queryTradedItem(itemId);
},2500);

function queryTradedItem(itemId){
    $.get("../index.php/itemtradedstatus/"+itemId, function(res){
        //console.log(res);
        if(res != null){
            tradedResponse();
        }
    },"json");
}

function tradedResponse(){
    swal({ 
        title: "Sorry, this item has been traded",
        text: "You shall be redirected to the homepage",
        type: "warning",
        timer: 2000,
        showConfirmButton: false
        },
        function(){
            window.location.href = 'homepage.php';
        }
    );       
}
</script>


<style>
     .hide-bullets {
    list-style:none;
    margin-left: -40px;
    margin-top:20px;
}

.thumbnail {
    padding: 0;
}

.carousel-inner>.item>img, .carousel-inner>.item>a>img {
    width: 100%;
}
</style>