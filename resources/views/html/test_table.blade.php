<div id="example-table2"></div>

<script type="text/javascript">

    $(document).ready(function () {



//create Tabulator on DOM element with id "example-table"
        $("#example-table2").tabulator({
            height: 205, // set height of table (in CSS or here), this enables the Virtual DOM and improves render speed dramatically (can be any valid css height value)
            layout: "fitColumns", //fit columns to width of table (optional)
            columns: [ //Define Table Columns
                {title: "Name", field: "name", width: 150},
                {title: "Age", field: "age", align: "left", formatter: "progress"},
                {title: "Favourite Color", field: "col"},
                {title: "Date Of Birth", field: "dob", sorter: "date", align: "center"},
            ],
            rowClick: function (e, row) { //trigger an alert message when the row is clicked
                alert("Row " + row.getData().id + " Clicked!!!!");
            }
        });


//define some sample data
        var tabledata = [
            {id: 1, name: "Oli Bob", age: "12", col: "red", dob: ""},
            {id: 2, name: "Mary May", age: "1", col: "blue", dob: "14/05/1982"},
            {id: 3, name: "Christine Lobowski", age: "42", col: "green", dob: "22/05/1982"},
            {id: 4, name: "Brendon Philips", age: "125", col: "orange", dob: "01/08/1980"},
            {id: 5, name: "Margret Marmajuke", age: "16", col: "yellow", dob: "31/01/1999"},
        ];

//load sample data into the table
        $("#example-table2").tabulator("setData", tabledata);


    });


</script>
