const editor = new DataTable.Editor({
    ajax: '../php/staff.php',
    fields: [
        {
            label: 'First name:',
            name: 'first_name'
        },
        {
            label: 'Last name:',
            name: 'last_name'
        },
        {
            label: 'Position:',
            name: 'position'
        },
        {
            label: 'Office:',
            name: 'office'
        },
        {
            label: 'Extension:',
            name: 'extn'
        },
        {
            label: 'Start date:',
            name: 'start_date',
            type: 'datetime'
        },
        {
            label: 'Salary:',
            name: 'salary'
        }
    ],
    table: '#example'
});
 
const table = new DataTable('#example', {
    ajax: '../php/staff.php',
    buttons: [
        { extend: 'create', editor },
        { extend: 'edit', editor },
        { extend: 'remove', editor }
    ],
    columns: [
        {
            data: null,
            defaultContent: '',
            className: 'select-checkbox',
            orderable: false
        },
        { data: 'first_name' },
        { data: 'last_name' },
        { data: 'position' },
        { data: 'office' },
        { data: 'start_date' },
        { data: 'salary', render: DataTable.render.number(null, null, 0, '$') },
        {
            data: null,
            defaultContent:
                '<div class="action-buttons">' +
                '<span class="edit"><i class="fa fa-pencil"></i></span> ' +
                '<span class="remove"><i class="fa fa-trash"></i></span> ' +
                '<span class="cancel"></span>' +
                '</div>',
            className: 'row-edit dt-center',
            orderable: false
        }
    ],
    dom: 'Bfrtip',
    order: [[1, 'asc']],
    select: {
        style: 'os',
        selector: 'td:first-child'
    }
});
 
// Activate an inline edit on click of a table cell
table.on('click', 'tbody td.row-edit', function (e) {
    editor.inline(table.cells(this.parentNode, '*').nodes(), {
        cancelHtml: '<i class="fa fa-times"></i>',
        cancelTrigger: 'span.cancel',
        submitHtml: '<i class="fa fa-floppy-o"></i>',
        submitTrigger: 'span.edit'
    });
});
 
// Delete row
table.on('click', 'tbody span.remove', function (e) {
    editor.remove(this.parentNode, {
        title: 'Delete record',
        message: 'Are you sure you wish to delete this record?',
        buttons: 'Delete'
    });
});