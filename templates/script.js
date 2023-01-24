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
            url: "roof/ajax",
            data: { action: 'showMaterialForInsert', id_coating: id_coating },
            cache: false,
            success: function(response){ $('div[name="selectDataMaterial"]').html(response); }
        });
    }
}

function selectTypeCoating(){
    var id_material = $('select[name="material_type"]').val();
    $.ajax({
        type: "POST",
        url: "roof/ajax",
        data: { action: 'showCityForInsert', id_material: id_material },
        cache: false,
        success: function(response){ $('div[name="selectDataTypeCoating"]').html(response); }
    });
}