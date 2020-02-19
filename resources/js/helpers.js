import {store} from "./store";

export const helpers = {
    sumOfAllContentsOfArray: function (arr) {
        let sum = 0;
        for (let i = 0; i < arr.length; i++) {
            if (typeof arr[i] == 'object')
                sum += helpers.sumOfAllContentsOfArray(arr[i]);
            else
                sum += arr[i];
        }
        return sum;
    },

    getTargetGroup: function(type,storeGroup,group){
        if(type!==null){
            return storeGroup.find(function (groupItem) {
                return groupItem.group_id === group.group_id && groupItem.type === type;
            });
        }else{
            return storeGroup.find(function (groupItem) {
                return groupItem.group_id === group.group_id;
            });
        }

    },
    getOldNote: function(targetGroup,note){
        return targetGroup.notes.find(function (noteItem) {
            return noteItem.group_note_id === note.group_note_id;
        });
    },
    getOldClass: function(oldNote,note,k){
        return oldNote.class_sheet.find(function (classItem) {
            return classItem.class_id === note.class_sheet[k].class_id;
        });
    },
    removeOldNote: function(targetGroup,oldNote){
        let index = targetGroup.notes.indexOf(oldNote);
        if (index > -1) {
            targetGroup.notes.splice(index, 1);
        }
    },
    addNewNote: function(targetGroup,note,sheet,sheet_value){
        let newNote = JSON.parse(JSON.stringify(note));
        newNote.total_sheet = parseInt(sheet);
        targetGroup.notes.push(newNote);
        if(targetGroup.currency_value && sheet_value!==null){
            targetGroup.currency_value.value=sheet_value;
        }
    },
    removeOldClass: function(oldNote,oldClass){
        let index = oldNote.class_sheet.indexOf(oldClass);
        if (index > -1) {
            oldNote.class_sheet.splice(index, 1);
        }
    },
    addNewClass: function(note,oldNote,sheet,k){
        let newClass = JSON.parse(JSON.stringify(note.class_sheet[k]));
        newClass.sheet = parseInt(sheet);
        oldNote.class_sheet.push(newClass);
    },

    calculateTotalSheet: function(storeGroup,type,sheet_value){
        storeGroup.forEach(function (groupItem) {
            if (groupItem.type === type) {
                groupItem.notes.forEach(function (noteItem) {
                    let total_sheet = 0;
                    noteItem.class_sheet.forEach(function (classItem) {
                        total_sheet = total_sheet + parseInt(classItem.sheet);
                    });
                    noteItem.total_sheet = total_sheet;
                });
                if(sheet_value!==null){
                    for(let value in groupItem.class_currency_value){
                        groupItem.class_currency_value[value].value= sheet_value[value];
                    }
                }

            }
        });
    },
    calculateTotalSheetForStock: function(storeGroup){
        storeGroup.forEach(function (groupItem) {
            groupItem.notes.forEach(function (noteItem) {
                let total_sheet = 0;
                noteItem.class_sheet.forEach(function (classItem) {
                    total_sheet = total_sheet + parseInt(classItem.sheet);
                });
                noteItem.total_sheet = total_sheet;
            });
        });
    },

    switchCustomValue: function(storeGroup,group,sheet_value){
        let targetGroup = helpers.getTargetGroup(null,storeGroup,group);
        for(let value in targetGroup.class_currency_value){
            targetGroup.class_currency_value[value].value = sheet_value[value];
        }
    },

    removeOldElementAndAddNew: function (type, storeGroup, sheet, group, note, k,sheet_value) {
        let targetGroup = helpers.getTargetGroup(type,storeGroup,group);
        let oldNote = helpers.getOldNote(targetGroup,note);
        if (k === null) {
            helpers.removeOldNote(targetGroup,oldNote);
            helpers.addNewNote(targetGroup,note,sheet,sheet_value);
        } else {
            let oldClass = helpers.getOldClass(oldNote,note,k);
            helpers.removeOldClass(oldNote,oldClass);
            helpers.addNewClass(note,oldNote,sheet,k);
            helpers.calculateTotalSheet(storeGroup,type,sheet_value);
        }
    },


     removeOldElementAndAddNewForStock: function (type, storeGroup, sheet, group, note, k,sheet_value,isMM) {
        let targetGroup = helpers.getTargetGroup(type,storeGroup,group);
        let oldNote = helpers.getOldNote(targetGroup,note);
        if(isMM){
            helpers.removeOldNote(targetGroup,oldNote);
            helpers.addNewNote(targetGroup,note,sheet,sheet_value);
        }else{
            let oldClass = helpers.getOldClass(oldNote,note,k);
            helpers.removeOldClass(oldNote,oldClass);
            helpers.addNewClass(note,oldNote,sheet,k);
            helpers.calculateTotalSheetForStock(storeGroup);
            helpers.switchCustomValue(storeGroup,group,sheet_value);
        }

    },


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



    setInitialSheetValues(type, group_value, lengths, storeGroup, isMM){
        for(let i=0; i<lengths.groups; i++){
            let row = [];
            for(let j=0; j<lengths.classes; j++){
                row.push(0);
            }
            group_value.push(row);
        }

        if(!isMM){

            let targetGroups = storeGroup.filter(function (group) {
                return group.type === type;
            });
            for(let groupItem in targetGroups) {
                    for(let classItem in targetGroups[groupItem].class_currency_value){
                        group_value[groupItem][classItem] = targetGroups[groupItem].class_currency_value[classItem].value;
                    }
            }
        }
    },

    setInitialGroups: function (type,original_data, isMM) {
        let _this = this;
        this.$store.commit('removeGroup', type);
        let groups = JSON.parse(JSON.stringify(original_data));
        groups.forEach(function (group) {
            group.type=type;
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
            _this.$store.commit('addGroup', group);
        });
    },


    updateInitialGroups: function (type,storeGroup,sheets, values, isMM) {
        let targetGroup = storeGroup.filter(function (groupItem) {
            return groupItem.type === type;
        });
        for(let groupItem in targetGroup){
            if(isMM){
                for(let noteItem in targetGroup[groupItem].notes){
                    targetGroup[groupItem].notes[noteItem].total_sheet = parseInt(sheets[groupItem][noteItem])
                }
            }else{
                if(values!==null){              //check if member
                    for(let classItem in targetGroup[groupItem].class_currency_value){
                        targetGroup[groupItem].class_currency_value[classItem].value = parseInt(values[groupItem][classItem]) ;
                    }
                }

                for(let noteItem in targetGroup[groupItem].notes){
                    let total_sheet = 0;
                    for(let classItem in targetGroup[groupItem].notes[noteItem].class_sheet){
                        targetGroup[groupItem].notes[noteItem].class_sheet[classItem].sheet = parseInt(sheets[groupItem][noteItem][classItem]);
                        total_sheet  = total_sheet+targetGroup[groupItem].notes[noteItem].class_sheet[classItem].sheet;
                    }
                    targetGroup[groupItem].notes[noteItem].total_sheet = total_sheet;
                }
            }
        }

    },


    calculateTotalMMK: function (type,storeGroup,isMM) {
        let total_mmk = 0;
        let targetGroup = storeGroup.filter(function (groupItem) {
            return groupItem.type === type;
        });
        for(let groupItem in targetGroup){
            let note_total = 0;
            for(let noteItem in targetGroup[groupItem].notes){
                let value, note_name, sheet;

                if(isMM){
                    value = 1;
                    note_name= parseInt(targetGroup[groupItem].notes[noteItem].note_name);
                    sheet = parseInt(targetGroup[groupItem].notes[noteItem].total_sheet);
                    note_total = note_total + (value*note_name*sheet);


                }else{
                    for(let classItem in targetGroup[groupItem].notes[noteItem].class_sheet){
                        value = targetGroup[groupItem].class_currency_value[classItem].value ;
                        note_name = parseInt(targetGroup[groupItem].notes[noteItem].note_name) ;
                        sheet = parseInt(targetGroup[groupItem].notes[noteItem].class_sheet[classItem].sheet) ;
                        note_total = note_total + (value*note_name*sheet);
                    }
                }
            }
            total_mmk = total_mmk+note_total;

        }
        return total_mmk;
    },


    calculateTotal: function (type,storeGroup,isMM) {
        let total = 0;
        let targetGroup = storeGroup.filter(function (groupItem) {
            return groupItem.type === type;
        });
        for(let groupItem in targetGroup){
            let note_total = 0;
            for(let noteItem in targetGroup[groupItem].notes){
                let  note_name, sheet;

                if(isMM){
                    note_name= parseInt(targetGroup[groupItem].notes[noteItem].note_name);
                    sheet = parseInt(targetGroup[groupItem].notes[noteItem].total_sheet);
                    note_total = note_total + (note_name*sheet);

                }else{
                    for(let classItem in targetGroup[groupItem].notes[noteItem].class_sheet){
                        note_name = parseInt(targetGroup[groupItem].notes[noteItem].note_name) ;
                        sheet = parseInt(targetGroup[groupItem].notes[noteItem].class_sheet[classItem].sheet) ;
                        note_total = note_total + (note_name*sheet);
                    }
                }
            }
            total = total+note_total;

        }
        return total;
    }


};
