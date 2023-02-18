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
console.log(text);
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
    var text = sel.options[sel.selectedIndex].value;
    var result;
    console.log(text)

    switch (text) {
        case 'roof1':
            var input1_1 = Number(document.getElementById('val_p1_1').value);
            var input2_1 = Number(document.getElementById('val_p1_2').value);
            result = input1_1 * input2_1;
            break;
        case 'roof2':
            var input1_2 = Number(document.getElementById('val_p2_1').value);
            var input2_2 = Number(document.getElementById('val_p2_2').value);
            var input3_2 = Number(document.getElementById('val_p2_3').value);
            result = (input1_2 * input2_2) + (input1_2 * input3_2)
            break;
        case 'roof3':
            break;
        case 'roof4':
            var input1_4 = Number(document.getElementById('val_p4_1').value);
            var input2_4 = Number(document.getElementById('val_p4_2').value);
            var input3_4 = Number(document.getElementById('val_p4_3').value);
            var input4_4 = Number(document.getElementById('val_p4_4').value);
            var sum = input2_4 + input3_4 + input2_4
            var p_triangle = sum / 2;
            console.log(p_triangle)
            var s_triangle = Math.sqrt((p_triangle * (p_triangle - input2_4) * (p_triangle - input2_4) * (p_triangle - input3_4)));
            console.log(s_triangle)
            var p_trap = (input1_4 + input2_4 + input3_4 + input4_4) / 2;
            console.log(p_trap)
            var s_trap = ((input1_4 + input4_4) / (Math.abs(input1_4 - input4_4)))*(Math.sqrt((p_trap - input4_4)*(p_trap - input1_4)*(p_trap - input4_4 - input2_4)*(p_trap - input4_4 - input2_4)))
            console.log(s_trap)
            result = (s_trap + s_triangle)*2
            console.log(result)
            break;
    }
    document.getElementById("result").style.display = "block";
    document.getElementById("result_square").innerHTML = result;

}