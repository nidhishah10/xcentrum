var ppp = 6; // Post per page
var pageNumber = 1;


function load_posts(){
    pageNumber++;
    var str = '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&action=more_post_ajax';
    jQuery.ajax({
        type: "POST",
        dataType: "json",
        url: ajax_posts.ajaxurl,
        data: str,
        success: function(response){
            console.log(response);
            if(response && response != '') {
                var html = '';
                for(var i = 0 ;  i < response.length ; i++) {

                    html += `<div class="service-col">
                <div class="service-inner">
                  <figure>
                    <img src="` + response[i].poster + `" alt="video-service" width="383" height="198">
                  </figure>
                  <div class="inner">
                    <h5>` + response[i].title + ` <i class="` + response[i].icon + `"></i></h5>
                    ` + response[i].content + `
                  </div>
                </div>
              </div>`;
                     
                }
            }

            $("#ajax-posts").append(html);
            if(response == null || response.length < 9){
              //$("#ajax_filter_search_results").append("<p class='reached-text'>You reached end of list</p>");  
              $("#more_posts").hide();
            }
                else{
                    $("#more_posts").show();
                }
            
        },
        error : function(jqXHR, textStatus, errorThrown) {
            $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }

    });
    return false;
}

jQuery("#more_posts").on("click",function(e){ // When btn is pressed.
    e.preventDefault();
    jQuery("#more_posts").attr("disabled",true); // Disable the button, temp.
    load_posts();
    //jQuery(this).insertAfter('#ajax-posts'); // Move the 'Load More' button to the end of the the newly added posts.
});

var yourArray = [];
var filterdata_new = [];
//jQuery(function($){
var merk = [];
var models = [];
var brandsof = [];
var years = [];
var kilometers = [];
var price = [];
var transmission = [];
var colors = [];

var update_array = function(){
   
    yourArray = [];
    merk = [];
    models = [];
    brandsof = [];
    years = [];
    kilometers = [];
    price = [];
    transmission = [];
    colors = [];
    filterdata_new = [];
    
    $('.accordion-row.merk .checkbox').each(function(){
        if ($(this).find('input[type=checkbox]').is(':checked')) {
            merk.push($(this).find('input[type=checkbox]').val());
        }
    });
    $('.accordion-row.model .checkbox').each(function(){
        if ($(this).find('input[type=checkbox]').is(':checked')) {
            models.push($(this).find('input[type=checkbox]').val());
        }
    });
    $('.accordion-row.brandsof .checkbox').each(function(){
        
        if ($(this).find('input[type=checkbox]').is(':checked')) {
            brandsof.push($(this).find('input[type=checkbox]').val());
        }
    });
    $('.accordion-row.year .checkbox').each(function(){
        
        if ($(this).find('input[type=checkbox]').is(':checked')) {
            years.push($(this).find('input[type=checkbox]').val());
        }
    });
    $('.accordion-row.kilometer .checkbox').each(function(){
        
        if ($(this).find('input[type=checkbox]').is(':checked')) {
            kilometers.push($(this).find('input[type=checkbox]').val());
        }
    });
    $('.accordion-row.transmission .checkbox').each(function(){
        
        if ($(this).find('input[type=checkbox]').is(':checked')) {
            transmission.push($(this).find('input[type=checkbox]').val());
        }
    });
    $('.accordion-row.color .checkbox').each(function(){
        
        if ($(this).find('input[type=checkbox]').is(':checked')) {
            colors.push($(this).find('input[type=checkbox]').val());
        }
    });

    
    filterdata_new.push({"merk": merk});
    filterdata_new.push({"models": models});
    filterdata_new.push({"brandsof": brandsof});
    filterdata_new.push({"years": years});
    filterdata_new.push({"kilometers": kilometers});
    filterdata_new.push({"transmission": transmission});
    filterdata_new.push({"colors": colors});
    /*filterdata_new[]["models"] = models;
    filterdata_new[]["brandsof"] = brandsof;
    filterdata_new[]["years"] = years;
    filterdata_new[]["kilometers"] = kilometers;
    filterdata_new[]["transmission"] = transmission;
    filterdata_new[]["colors"] = colors; */
    
    $('.checkbox').each(function(){
        if ($(this).find('input[type=checkbox]').is(':checked')) {
            yourArray.push($(this).find('input[type=checkbox]').val());
        }
    });
     //console.log('checked');
}

$(document).on("change",".price_van,.price_tot,.year_from,.year_to,.km_from,.km_to",function(){
    update_array();
    $('#filter').submit();
})



$(document).on('click','.checkbox input[type=checkbox]', function(){

    if($(this).attr('name') == "van" || $(this).attr('name') == "tot"){
       if($(this).attr('name') == "van"){
        if($(this).is(':checked') ){
            $('input[name="van"]').prop('checked',false);
            $(this).prop('checked',true);
        }else{
            $('input[name="van"]').prop('checked',false);
        }
       
       }else{
        if($(this).is(':checked') ){
            $('input[name="tot"]').prop('checked',false);
            $(this).prop('checked',true);
        }else{
            $('input[name="tot"]').prop('checked',false);
        }
       }
        update_array();
        $('#filter').submit();
    }else{
        
        update_array();
        if($(this).closest('.accordion-row').hasClass('merk')){
            models = [];
            brandsof = [];
            years = [];
            kilometers = [];
            colors = [];
        }
        $('#filter').submit();
    }
    
    
});

$(document).on('click','.pagination li a',function(){
    var current_page = $(this).attr('data-value');
    $('.main-listing').find('li').removeClass('active');
    $(this).parent().addClass('active');
    update_array();
    $('#filter').submit();
})

$('#filter').submit(function(){
  //  console.log(filterdata);
    var van = jQuery('input[name="price_van"]').val();
    var tot = jQuery('input[name="price_tot"]').val();
    var year_from = jQuery('.year_from').val();
    var year_to = jQuery('.year_to').val();
    var km_from = jQuery('input[name="km_from"]').val();
    var km_to = jQuery('input[name="km_to"]').val();
    var search_val =  jQuery('#txtSearch').val();
    
    var current_page = 1;
    if($('.main-listing').find('li.active').length > 0){
        current_page = $('.main-listing').find('li.active a').attr('data-value');
    }

    var data = {
        action : "myfilter",
        van_price:van,
        current_page: current_page,
        tot_price:tot,
        year_from: year_from,
        year_to:year_to,
        km_from: km_from,
        km_to: km_to,
        filter__data: { 
                        "merk": merk,
                        "models": models,
                        "brandsof": brandsof,
                        "years": years,
                        "kilometers": kilometers,
                        "transmission": transmission,
                        "colors": colors
                    },
        search_val: search_val,
        array : yourArray
    }
    console.log(data);
    var filter = $('#filter');
    
    $('body').find('.loader').remove();
    $('body').append('<div class="loader"><span>wordt geladen...</span></div>');
    $.ajax({
        url:filter.attr('action'),
        data:data,
        //van_price:van,
        type:filter.attr('method'), // POST
        beforeSend:function(xhr){
            
        },
        success:function(result){
            var temp_result = JSON.parse(result);
         
            
            if(typeof temp_result.output != "undefined"){
                $('html, body').animate({
                    scrollTop: $(".number-of-vehicles-sec").offset().top
                }, 300);
                $('.selection-stock-blocks').html(temp_result.output); // insert data
                console.log("I AM HERE");
                console.log(temp_result.models);
                console.log(models);
                
                if(temp_result.models.length > 0){
                    html_model = '';             
                           
                    for (let index = 0; index < temp_result.models.length; index++) {
                        var checked = "";
                        if(jQuery.inArray( temp_result.models[index], models ) >= 0){
                            checked = " checked";
                        }
                        html_model += '<div class="form-group"><div class="checkbox"><label for="default-checkbox"><input type="checkbox" id="default-checkbox" value="'+temp_result.models[index]+'" '+checked+'><em class="input-helper"></em><span>'+temp_result.models[index]+'</span></label></div></div>'
                    }

                    $('.accordion-row.model .accordion-data .form-block').html(html_model);
                }
                if(temp_result.brandsoff.length > 0){
                    
                    html_brandsoff = '';             
                           
                    for (let index = 0; index < temp_result.brandsoff.length; index++) {
                        var checked = "";
                        if(jQuery.inArray( temp_result.brandsoff[index], brandsof ) >= 0){
                            checked = " checked";
                        }
                        html_brandsoff += '<div class="form-group"><div class="checkbox"><label for="default-checkbox"><input type="checkbox" id="default-checkbox" value="'+temp_result.brandsoff[index]+'" '+checked+'><em class="input-helper"></em><span>'+temp_result.brandsoff[index]+'</span></label></div></div>'
                    }

                    $('.accordion-row.brandsof .accordion-data .form-block').html(html_brandsoff);
                }
                if(temp_result.bouwjaar.length > 0){
                    html_years = '';             
                           
                    for (let index = 0; index < temp_result.bouwjaar.length; index++) {
                        var checked = "";
                        if(jQuery.inArray( temp_result.bouwjaar[index], years ) >= 0){
                            checked = " checked";
                        }
                        html_years += '<div class="form-group"><div class="checkbox"><label for="default-checkbox"><input type="checkbox" id="default-checkbox" value="'+temp_result.bouwjaar[index]+'" '+checked+'><em class="input-helper"></em><span>'+temp_result.bouwjaar[index]+'</span></label></div></div>'
                    }

                    $('.accordion-row.year .accordion-data .form-block').html(html_years);
                }

                if(temp_result.colors.length > 0){
                    html_colors = '';             
                           
                    for (let index = 0; index < temp_result.colors.length; index++) {
                        var checked = "";
                        if(jQuery.inArray( temp_result.colors[index], colors ) >= 0){
                            checked = " checked";
                        }
                        html_colors += '<div class="form-group"><div class="checkbox"><label for="default-checkbox"><input type="checkbox" id="default-checkbox" value="'+temp_result.colors[index]+'" '+checked+'><em class="input-helper"></em><span>'+temp_result.colors[index]+'</span></label></div></div>'
                    }

                    $('.accordion-row.color .accordion-data .form-block').html(html_colors);
                }

                if(temp_result.kilometers.length > 0){
                    html_km = '';             
                           
                    for (let index = 0; index < temp_result.kilometers.length; index++) {
                        var checked = "";
                        if(jQuery.inArray( temp_result.kilometers[index], kilometers ) >= 0){
                            checked = " checked";
                        }
                        html_km += '<div class="form-group"><div class="checkbox"><label for="default-checkbox"><input type="checkbox" id="default-checkbox" value="'+temp_result.kilometers[index]+'" '+checked+'><em class="input-helper"></em><span>'+temp_result.kilometers[index]+'</span></label></div></div>'
                    }

                    $('.accordion-row.color .accordion-data .form-block').html(html_km);
                }

                if(temp_result.transmission.length > 0){
                    html_transmission = '';             
                           
                    for (let index = 0; index < temp_result.transmission.length; index++) {
                        var checked = "";
                        if(jQuery.inArray( temp_result.transmission[index], transmission ) >= 0){
                            checked = " checked";
                        }
                        html_transmission += '<div class="form-group"><div class="checkbox"><label for="default-checkbox"><input type="checkbox" id="default-checkbox" value="'+temp_result.transmission[index]+'" '+checked+'><em class="input-helper"></em><span>'+temp_result.transmission[index]+'</span></label></div></div>'
                    }

                    $('.accordion-row.transmission .accordion-data .form-block').html(html_transmission);
                }
                
                if(temp_result.total_pages > 1){
                    pages_html = '<div class="pagination" ><ul>';
                    for (let index = 1; index <= temp_result.total_pages; index++) {
                        if(index == temp_result.current_page){
                            pages_html += '<li ><span>'+index+'</span></li>';
                        }else{
                            pages_html += '<li><a data-value="'+index+'" href="javascript:void(0)">'+index+'</a></li>';
                        }
                        
                    }
                    pages_html += '</ul></div>';
                    $('.tablenav').remove();
                    $('.main-listing').find('.pagination').remove();

                    $('.main-listing').append(pages_html);
                    var largest = 0;
                    $(document).find(".stock-car-details h4").each(function(){
                        var findHeight = $(this).height();
                        if(findHeight > largest){
                            largest = Math.round(findHeight);
                        }  
                    });
                    $(document).find(".stock-car-details h4").css({"min-height":largest+"px"});
                    var largestp = 0;
                    $(document).find(".stock-car-details p").each(function(){
                        var findHeightp = $(this).height();
                        if(findHeightp > largestp){
                            largestp = Math.round(findHeightp);
                        }  
                    });
                    $(document).find(".stock-car-details p").css({"min-height":largestp+"px"});
                    var largestu = 0;
                    $(document).find(".stock-car-details ul").each(function(){
                        var findHeightu = $(this).height();
                        if(findHeightu > largestu){
                            largestu = Math.round(findHeightu);
                        }  
                    });
                    $(document).find(".stock-car-details ul").css({"min-height":largestu+"px"});
                }else{
                    $('.tablenav').remove();
                    $('.main-listing').find('.pagination').remove();
                }
            } 
            //filter.find('button').text('Apply filter'); // changing the button label back
            setTimeout(() => {
                $('body').find('.loader').remove();
            }, 1000);
        }
    });
    return false;
	});

 $('.search-suggestion a').click(function(){
    var search_val = $(this).attr('data-value');
    $('#txtSearch').val(search_val);
    $('a.search_data').trigger('click');    
 });   
$('a.search_data').click(function(){ 
    yourArray = [];
    $('.checkbox').each(function(){
        if ($(this).find('input[type=checkbox]').is(':checked')) {
            yourArray.push($(this).find('input[type=checkbox]').val());
        }
    });
    $('#filter').submit();
    /*
    var van = jQuery('input[name="van"]:checked').val();
var tot = jQuery('input[name="tot"]:checked').val();
var search_val =  jQuery('#txtSearch').val();


var data = {
    action : "myfilter",
    van_price:van,
    tot_price:tot,
    search_val: search_val,
    array : yourArray
}
window.location.replace("http://64.4.160.99/xcentrum_dev/offer?search_data="+search_val+"");
    console.log(yourArray);
        var filter = $('#filter');
        
        //console.log(van);
        $.ajax({
            url:filter.attr('action'),
            data:data,
            //van_price:van,
            type:filter.attr('method'), // POST
            beforeSend:function(xhr){
                
            },
            success:function(data){
                
                //filter.find('button').text('Apply filter'); // changing the button label back
                $('.selection-stock-blocks').html(data); // insert data
            }
        });
        return false;

        */
    });

/*$('#search_data').click(function() {
    var search_data = this.value;
    console.log(search_data);
    window.location.replace("http://64.4.160.99/xcentrum_dev/offer?search_data="+search_data+"");
});
*/
/*
$('#model').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    window.location.replace("http://64.4.160.99/xcentrum_dev/offer?model="+valueSelected+"");
    //console.log(valueSelected);
});

$('#brandsof').on('change', function (e) {
    var optionSelectedBrandsof = $("option:selected", this);
    var valueSelectedBrandsof = this.value;
    //console.log(valueSelectedBrandsof);
    window.location.replace("http://64.4.160.99/xcentrum_dev/offer?brandsof="+valueSelectedBrandsof+"");
});

$('#bouwjaar').on('change', function (e) {
    var optionSelectedYear = $("option:selected", this);
    var valueSelectedYear = this.value;
    window.location.replace("http://64.4.160.99/xcentrum_dev/offer?bouwjaar="+valueSelectedYear+"");
    //console.log(valueSelectedYear);
});

$('#price').on('change', function (e) {
    var optionSelectedPrice = $("option:selected", this);
    var valueSelectedPrice = this.value;
    window.location.replace("http://64.4.160.99/xcentrum_dev/offer?price="+valueSelectedPrice+"");
    //console.log(valueSelectedPrice);
});
*/