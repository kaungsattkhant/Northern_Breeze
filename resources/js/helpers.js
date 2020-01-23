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

    removeOldElementAndAddNew: function (type, storeGroup, sheet, group, note, k = null) {
        let targetGroup = storeGroup.find(function (groupItem) {
            return groupItem.group_id === group.group_id && groupItem.type === type;
        });
        let oldNote = targetGroup.notes.find(function (noteItem) {
            return noteItem.group_note_id === note.group_note_id;
        });
        if (k === null) {
            let index = targetGroup.notes.indexOf(oldNote);
            if (index > -1) {
                targetGroup.notes.splice(index, 1);
            }
            let newNote = JSON.parse(JSON.stringify(note));
            newNote.total_sheet = parseInt(sheet);
            targetGroup.notes.push(newNote);
            // targetGroup.currency_value.value=sheet_value;
        } else {
            let oldClass = oldNote.class_sheet.find(function (classItem) {
                return classItem.class_id === note.class_sheet[k].class_id;
            });
            let index = oldNote.class_sheet.indexOf(oldClass);
            if (index > -1) {
                oldNote.class_sheet.splice(index, 1);
            }
            let newClass = JSON.parse(JSON.stringify(note.class_sheet[k]));
            newClass.sheet = parseInt(sheet);
            oldNote.class_sheet.push(newClass);

            storeGroup.forEach(function (groupItem) {
                if (groupItem.type === type) {
                    groupItem.notes.forEach(function (noteItem) {
                        let total_sheet = 0;
                        noteItem.class_sheet.forEach(function (classItem) {
                            total_sheet = total_sheet + parseInt(classItem.sheet);
                        });
                        noteItem.total_sheet = total_sheet;
                    });
                    // for(let value in groupItem.class_currency_value){
                    //     groupItem.class_currency_value[value].value= sheet_value[value];
                    // }

                }

            });
        }

    },
    removeOldElementAndAddNewForMember: function (type, sheet_value,storeGroup, sheet, group, note, k = null) {
        let targetGroup = storeGroup.find(function (groupItem) {
            return groupItem.group_id === group.group_id && groupItem.type === type;
        });
        let oldNote = targetGroup.notes.find(function (noteItem) {
            return noteItem.group_note_id === note.group_note_id;
        });
        if (k === null) {
            let index = targetGroup.notes.indexOf(oldNote);
            if (index > -1) {
                targetGroup.notes.splice(index, 1);
            }
            let newNote = JSON.parse(JSON.stringify(note));
            newNote.total_sheet = parseInt(sheet);
            targetGroup.notes.push(newNote);
            targetGroup.currency_value.value=sheet_value;
        } else {
            let oldClass = oldNote.class_sheet.find(function (classItem) {
                return classItem.class_id === note.class_sheet[k].class_id;
            });
            let index = oldNote.class_sheet.indexOf(oldClass);
            if (index > -1) {
                oldNote.class_sheet.splice(index, 1);
            }
            let newClass = JSON.parse(JSON.stringify(note.class_sheet[k]));
            newClass.sheet = parseInt(sheet);
            oldNote.class_sheet.push(newClass);

            storeGroup.forEach(function (groupItem) {
                if (groupItem.type === type) {
                    groupItem.notes.forEach(function (noteItem) {
                        let total_sheet = 0;
                        noteItem.class_sheet.forEach(function (classItem) {
                            total_sheet = total_sheet + parseInt(classItem.sheet);
                        });
                        noteItem.total_sheet = total_sheet;
                    });
                    for(let value in groupItem.class_currency_value){
                        groupItem.class_currency_value[value].value= sheet_value[value];
                    }

                }

            });
        }

    },



    setInitialSheets(lengths, sheet, isClass) {
        if (isClass) {
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
        } else {
            for (let i = 0; i < lengths.groups; i++) {
                let row = [];
                for (let j = 0; j < lengths.notes; j++) {
                    row.push(0);
                }
                sheet.push(row);
            }
        }
    },

    setInitialSheetValues(groups,sheet_values,isClass){
        if(isClass){
            groups.forEach(function (groupItem) {
                let row=[];
                    for(let value in groupItem.class_currency_value){
                        row.push(groupItem.class_currency_value[value].value );
                    }
                sheet_values.push(row);
            })
        }else{
            groups.forEach(function (groupItem) {
                sheet_values.push(groupItem.currency_value.value);
            })
        }
    },
    setInitialGroups: function (type, data, isClass) {
        let _this = this;
        this.$store.commit('removeGroup', type);
        let newGroup = JSON.parse(JSON.stringify(data));
        newGroup.groups.forEach(function (group) {
            group.type = type;
            group.notes.forEach(function (note) {
                if (isClass) {
                    let total_sheet = 0;
                    note.class_sheet.forEach(function (item) {

                        item.sheet = 0;
                        total_sheet = total_sheet + item.sheet;
                    });
                    note.total_sheet = total_sheet;
                } else {
                    note.total_sheet = 0;
                }
            });
            _this.$store.commit('addGroup', group);
        });
    },

};
