export const helpers = {
    testConsole: function (param) {
        console.log(param)
    },
    sumOfAllContentsOfArray: function (arr) {
        let sum = 0;
        for (let i = 0; i < arr.length; i++) {
            if (typeof arr[i] == 'object')
                sum += helpers.sumOfAllContentsOfArray(arr[i]);
            else
                sum += arr[i];
        }
        return sum;
    }
};
