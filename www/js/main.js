/**
 * Created by betit on 31/05/2017.
 */
var cards = [];

$(function(){

    // Multiple Select
    $(".select-1").select2({
        placeholder: "Select Multiple Values"
    });

    $("form[name='frm-card']").on("submit",function(){
        var _params = $(this).serializeArray();
        var _cardStructure = {
        };
        for (var i in _params){
            _cardStructure[_params[i].name] = _params[i].value;
        }
        cards.push(_cardStructure);

        $("#request-pre").html(JSON.stringify(cards));

        toastr.success('Card added to JSON Request','Card succesfully added');
        return false;
    });

    $("form#generate-itinerary").on("submit",function(){

        if (cards.length==0){
            toastr.error('Add at least a card','Itinerary cannot be created');
            return false;
        }
        $.post("/",{"data":JSON.stringify(cards)},function(data){
            $("#json-response").text(JSON.stringify(data));
            var _it = "";
            for (var i in data){
                _it += '<li> <a class="i-circled i-bordered i-alt divcenter">'+parseInt(i)+'</a> <h5>'+data[i].from.replace('Cities\\','')+'</h5></li>';
            }
            var j = parseInt(i)+1;
            _it += '<li> <a class="i-circled i-bordered i-alt divcenter">'+ j +'</a> <h5>'+data[i].to.replace('Cities\\','')+'</h5></li>';
            $("#itinerary-panel ul").html(_it);

        },"json").error(function(error){
            var _error = error.responseJSON.error;
            toastr.error(_error,'Itinerary cannot be created');
        });
        return false;
    });
});