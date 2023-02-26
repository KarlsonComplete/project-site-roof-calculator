class Validate {
    roof1(input1_1,input2_1){
        var valid = true;
        if(input1_1 === 0 || input2_1 === 0){
        alert('Пожалуйста заполните поля!');
        valid = false;
        }
        return valid;
    }
}