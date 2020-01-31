export const stock_helpers = {

    setInitialSheet(sheet, lengths, isMM) {
        if (isMM) {
            for (let i = 0; i < lengths.groups; i++) {
                let row = [];
                for (let j = 0; j < lengths.notes; j++) {
                    row.push(0);
                }
                sheet.push(row);
            }
        } else {
            for (let i = 0; i < lengths.groups; i++) {
                let row = [];
                for (let j = 0; j < lengths.notes; j++) {
                    let column = [];
                    for (let k = 0; k < lengths.classes; k++) {
                        column.push(0);
                    }
                    row.push(column);
                }
                sheet.push(row);
            }
        }
    },


    setInitialGroupValue(group_value, lengths, storeGroup,isMM){
        for(let i=0; i<lengths.groups; i++){
            let row = [];
            for(let j=0; j<lengths.classes; j++){
                row.push(0);
            }
            group_value.push(row);
        }

        if(!isMM){
            for(let groupItem in storeGroup) {
                for(let classItem in storeGroup[groupItem].class_currency_value){
                    group_value[groupItem][classItem] = storeGroup[groupItem].class_currency_value[classItem].value;
                }
            }
        }
        },


    setInitialGroups: function (original_data, isMM) {
        let _this = this;
        this.$store.commit('resetStockGroup');
        let groups = JSON.parse(JSON.stringify(original_data));
        groups.forEach(function (group) {
            group.notes.forEach(function (note) {
                if (isMM) {
                    note.total_sheet = 0;
                } else {
                    let total_sheet = 0;
                    note.class_sheet.forEach(function (item) {
                        item.sheet = 0;
                        total_sheet = total_sheet + item.sheet;
                    });
                    note.total_sheet = total_sheet;
                }
            });
            _this.$store.commit('addStockGroup', group);
        });
    },

    updateInitialGroups: function (storeGroup,sheets,values,isMM) {
        for(let groupItem in storeGroup){
            if(isMM){
                for(let noteItem in storeGroup[groupItem].notes){
                    storeGroup[groupItem].notes[noteItem].total_sheet = parseInt(sheets[groupItem][noteItem])
                }
            }else{
                for(let classItem in storeGroup[groupItem].class_currency_value){
                    storeGroup[groupItem].class_currency_value[classItem].value = parseInt(values[groupItem][classItem]);
                }
                for(let noteItem in storeGroup[groupItem].notes){
                    let total_sheet = 0;
                    for(let classItem in storeGroup[groupItem].notes[noteItem].class_sheet){
                        storeGroup[groupItem].notes[noteItem].class_sheet[classItem].sheet = parseInt(sheets[groupItem][noteItem][classItem]);
                       total_sheet  = total_sheet+storeGroup[groupItem].notes[noteItem].class_sheet[classItem].sheet;
                    }
                    storeGroup[groupItem].notes[noteItem].total_sheet = total_sheet;
                }
            }
        }

    },

    calculateTotalMMK: function (storeGroup,isMM) {
        let total_mmk = 0;
        for(let groupItem in storeGroup){
            let note_total = 0;
            for(let noteItem in storeGroup[groupItem].notes){
                let value, note_name, sheet;

                if(isMM){
                    value = 1;
                    note_name= storeGroup[groupItem].notes[noteItem].note_name;
                    sheet = storeGroup[groupItem].notes[noteItem].total_sheet;
                    note_total = note_total + (value*note_name*sheet);


                }else{
                    for(let classItem in storeGroup[groupItem].notes[noteItem].class_sheet){
                        value = storeGroup[groupItem].class_currency_value[classItem].value;
                        note_name = storeGroup[groupItem].notes[noteItem].note_name;
                        sheet = storeGroup[groupItem].notes[noteItem].class_sheet[classItem].sheet;
                        note_total = note_total + (value*note_name*sheet);
                    }
                }
            }
            total_mmk = total_mmk+note_total;

        }
        return total_mmk;
    },


};
