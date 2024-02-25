<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turnover</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
        }
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-light bg-light">
    <div class="container-fluid justify-content-center">
        <h1 class="navbar-brand">TURNOVER</h1>
    </div>
</nav>

<div class="container">
    <h3 class="text-primary text-center">Sales</h3>
    <table class="table">
        <thead>
        <tr>
            <th>No</th>
            <th>Amount</th>
            <th>Sale Name</th>
            <th>Place</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody id="sales-table-body">
        <tr>
            <td>1</td>
            <td><input type="number" name="amount"></td>
            <td><input type="text" name="name"></td>
            <td><input type="text" name="place"></td>
            <td><input type="text" name="description"></td>
            <td><button type="button" class="btn btn-sm btn-primary btn-add-row">Save</button></td>
        </tr>
        </tbody>
    </table>
    
    <tfoot>
        <td>Total Sales :- <h5 id="total-amount"></h5></td>
    </tfoot>
</div>



<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
    // Function to add a new row to the table
    function addRow() {
        let tableBody = document.getElementById("sales-table-body");
        let rowCount = tableBody.rows.length;
        let newRow = tableBody.insertRow(rowCount);

        let cell1 = newRow.insertCell(0);
        let cell2 = newRow.insertCell(1);
        let cell3 = newRow.insertCell(2);
        let cell4 = newRow.insertCell(3);
        let cell5 = newRow.insertCell(4);
        let cell6 = newRow.insertCell(5);

        cell1.innerHTML = rowCount + 1;
        cell2.innerHTML = '<input type="number" name="amount">';
        cell3.innerHTML = '<input type="text" name="name">';
        cell4.innerHTML = '<input type="text" name="place">';
        cell5.innerHTML = '<input type="text" name="description">';
        cell6.innerHTML = '<button type="button" class="btn btn-sm btn-primary">Save</button>';

        // Add event listener to the new input for real-time calculation
        cell2.querySelector('input').addEventListener('input', calculateTotal);
        calculateTotal();
    }

    // Function to calculate the total amount
    function calculateTotal() {
        let total = 0;
        let amounts = document.querySelectorAll('input[name="amount"]');
        amounts.forEach(input => {
            total += parseFloat(input.value) || 0;
        });
        document.getElementById('total-amount').textContent = total.toFixed(2);
    }

    // Add event listener to the "Add Row" button
    document.querySelector('.btn-add-row').addEventListener('click', addRow);

    // Calculate total on initial load
    calculateTotal();
</script>

</body>
</html>
