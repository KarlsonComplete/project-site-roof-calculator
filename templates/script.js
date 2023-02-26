function MaterialChange() {
    /*document.getElementById('address').innerHTML = document.getElementById(document.getElementById('primer').value).innerHTML*/

    var opt = document.getElementById('primer');
    var text = opt.options[opt.selectedIndex].value;

    document.getElementById("roof1").style.display = "none";
    document.getElementById("roof2").style.display = "none";
    document.getElementById("roof3").style.display = "none";
    document.getElementById("roof4").style.display = "none";
    document.getElementById("roof5").style.display = "none";
    document.getElementById("roof6").style.display = "none";

    switch (text) {
        case 'roof1':
            document.getElementById("roof1").style.display = "block";
            break;
        case 'roof2':
            document.getElementById("roof2").style.display = "block";
            break;
        case 'roof3':
            document.getElementById("roof3").style.display = "block";
            break;
        case 'roof4':
            document.getElementById("roof4").style.display = "block";
            break;
        case 'roof5':
            document.getElementById("roof5").style.display = "block";
            break;
        case 'roof6':
            document.getElementById("roof6").style.display = "block";
            break;
    }
}

function calculate() {

    var sel = document.getElementById("primer");
    var sel_coatings = document.getElementById('coating');
    var sel_material_type = document.getElementById('material_type');
    var sel_select_material = document.getElementById('select_material');
    var type = sel.options[sel.selectedIndex].value;
    var text = sel.options[sel.selectedIndex].text;
    var text_coating = sel_coatings.options[sel_coatings.selectedIndex].text
    var text_material_type = sel_material_type.options[sel_material_type.selectedIndex].text
    var text_select_material = sel_select_material.options[sel_select_material.selectedIndex].text
    var calculator = new Calculator();
    var validate = new Validate();
    var result;
    console.log(type)

    switch (type) {
        case 'roof1':
            var input1_1 = Number(document.getElementById('val_p1_1').value);
            var input2_1 = Number(document.getElementById('val_p1_2').value);
            var valid = validate.roof1(input1_1,input2_1);
            result = calculator.roof1(input1_1, input2_1);

            break;
        case 'roof2':
            var input1_2 = Number(document.getElementById('val_p2_1').value);
            var input2_2 = Number(document.getElementById('val_p2_2').value);
            var input3_2 = Number(document.getElementById('val_p2_3').value);
            result = calculator.roof2(input1_2,input2_2,input3_2)
            break;
        case 'roof3':
            var input1_3 = Number(document.getElementById('val_p3_1').value);
            var input2_3 = Number(document.getElementById('val_p3_2').value);
            var input3_3 = Number(document.getElementById('val_p3_3').value);
            result = calculator.roof3(input1_3, input2_3, input3_3)
            break;
        case 'roof4':
            var input1_4 = Number(document.getElementById('val_p4_1').value);
            var input2_4 = Number(document.getElementById('val_p4_2').value);
            var input3_4 = Number(document.getElementById('val_p4_3').value);
            var input4_4 = Number(document.getElementById('val_p4_4').value);
            result = calculator.roof4(input1_4,input2_4,input3_4,input4_4)
            break;
    }
    if (result === 0){

    }else {
        document.getElementById("result").style.display = "block";
        document.getElementById("result_roof_area").innerHTML = result;
        document.getElementById("result_roof_shape").innerHTML = text;
        document.getElementById("result_roof_material").innerHTML = text_coating;
        document.getElementById("result_roof_type").innerHTML = text_material_type;
        document.getElementById("result_roof_coating").innerHTML = text_select_material;
    }


}