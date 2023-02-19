class Calculator {

    roof1(input1_1, input2_1) {
        return input1_1 * input2_1;
    }

    roof2(input1_2, input2_2, input3_2) {
        return (input1_2 * input2_2) + (input1_2 * input3_2)
    }

    roof3(input1_3,input2_3,input3_3){
        var sum = input1_3 + input2_3 + input3_3
        var p_triangle = sum / 2;
        var s_triangle = Math.sqrt((p_triangle * (p_triangle - input2_3) * (p_triangle - input2_3) * (p_triangle - input3_3)));
        return s_triangle * 4;
    }

    roof4(input1_4, input2_4, input3_4, input4_4) {
        var sum = input2_4 + input3_4 + input2_4
        var p_triangle = sum / 2;
        var s_triangle = Math.sqrt((p_triangle * (p_triangle - input2_4) * (p_triangle - input2_4) * (p_triangle - input3_4)));
        var p_trap = (input1_4 + input2_4 + input3_4 + input4_4) / 2;
        if (input1_4 === input4_4) {
            var s_square = input2_4 * input4_4;
            return (s_square + s_triangle) * 2;
        } else {
            var s_trap = ((input1_4 + input4_4) / (Math.abs(input1_4 - input4_4))) * (Math.sqrt((p_trap - input4_4) * (p_trap - input1_4) * (p_trap - input4_4 - input2_4) * (p_trap - input4_4 - input2_4)))
            return (s_trap + s_triangle) * 2
        }
    }
}