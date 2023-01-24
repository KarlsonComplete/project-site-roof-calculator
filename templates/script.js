function MaterialChange() {
    document.getElementById('address').innerHTML = document.getElementById(document.getElementById('primer').value).innerHTML
}


function selectMaterial(){
    var id_coating = $('select[name="coating"]').val();
    if(!id_coating){
        $('div[name="selectDataMaterial"]').html('');
        $('div[name="selectDataTypeCoating"]').html('');
    }else{
        $.ajax({
            type: "POST",
            url: "/handler/ajax.base.php",
            data: { action: 'showMaterialForInsert', id_coating: id_coating },
            cache: false,
            success: function(response){ $('div[name="selectDataMaterial"]').html(response); }
        });
    }
}

function selectTypeCoating(){
    var id_material = $('select[name="region"]').val();
    $.ajax({
        type: "POST",
        url: "/handler/ajax.base.php",
        data: { action: 'showCityForInsert', id_material: id_material },
        cache: false,
        success: function(responce){ $('div[name="selectDataTypeCoating"]').html(responce); }
    });
}