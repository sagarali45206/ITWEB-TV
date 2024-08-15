<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 2px;
            background-color: #f8f9fa;
            max-width: 100%;
            width: 100%;
            margin: 0;
        }
        h2 {
            color: #343a40;
        }
        form {
            background-color: #ffffff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
            margin: auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #495057;
        }
        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            grid-column: span 2;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #dee2e6;
        }
        th, td {
            padding: 3px;
            text-align: left;
            font-size: 11px;
        }
        th {
            background-color: #e9ecef;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .edit-btn {
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            border-radius: 3px;
            transition: background-color 0.3s;
        }
        .edit-btn:hover {
            background-color: #218838;
        }
        .editable-cell {
            cursor: pointer;
        }
        .filter-container {
            max-width: 600px;
            margin: auto;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .filter-container select, .filter-container input[type="text"] {
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            width: 100%;
        }
    </style>
</head>
<body>
    <h2>Add Channel</h2>
    <form action="admin.php" method="post">
        <div>
            <label for="cname">Channel Name:</label>
            <input type="text" id="cname" name="cname" required>
        </div>
        
        <div>
            <label for="clogo">Channel Logo URL:</label>
            <input type="text" id="clogo" name="clogo" required>
        </div>
        
        <div>
            <label for="curl">Channel URL:</label>
            <input type="text" id="curl" name="curl" required>
        </div>
        
        <div>
            <label for="ccategory">Channel Category:</label>
            <input type="text" id="ccategory" name="ccategory" required>
        </div>
        
        <input type="submit" name="add_channel" value="Add Channel">
    </form>

    <div class="filter-container">
        <label for="category-filter">Filter by Category:</label>
        <select id="category-filter" onchange="filterTable()">
            <option value="">All Categories</option>
            <?php
           include('db.php');

            // Fetch unique categories from database
            $sql = "SELECT DISTINCT CCATEGORY FROM `tv channels`";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["CCATEGORY"] . "'>" . $row["CCATEGORY"] . "</option>";
                }
            }
            ?>
        </select>

        <label for="search">Search:</label>
        <input type="text" id="search" onkeyup="searchTable()" placeholder="Search by Channel Name">
    </div>

    <h2>Channels List</h2>
    <table id="channel-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Channel Name</th>
                <th>Channel Logo</th>
                <th>Channel URL</th>
                <th>Channel Category</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch channels from database
            $sql = "SELECT * FROM `tv channels`";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td id='id-" . $row["ID"] . "'>" . $row["ID"] . "</td>";
                    echo "<td contenteditable='true' id='cname-" . $row["ID"] . "'>" . $row["CNAME"] . "</td>";
                    echo "<td contenteditable='true' id='clogo-" . $row["ID"] . "'>" . $row["CLOGO"] . "</td>";
                    echo "<td contenteditable='true' id='curl-" . $row["ID"] . "'>" . $row["CURL"] . "</td>";
                    echo "<td contenteditable='true' id='ccategory-" . $row["ID"] . "'>" . $row["CCATEGORY"] . "</td>";
                    echo "<td><button class='edit-btn' onclick='updateChannel(" . $row["ID"] . ")'>Save</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No channels found</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>

    <script>
        function searchTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("channel-table");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1]; // Index 1 for Channel Name column
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function filterTable() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("category-filter");
            filter = input.value.toUpperCase();
            table = document.getElementById("channel-table");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[4]; // Index 4 for Channel Category column
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1 || filter === '') {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }

        function updateChannel(id) {
            var cname = document.getElementById("cname-" + id).innerText;
            var clogo = document.getElementById("clogo-" + id).innerText;
            var curl = document.getElementById("curl-" + id).innerText;
            var ccategory = document.getElementById("ccategory-" + id).innerText;

            // AJAX request to update channel
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_channel.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText); // Display response from server
                }
            };
            xhr.send("id=" + id + "&cname=" + cname + "&clogo=" + clogo + "&curl=" + curl + "&ccategory=" + ccategory);
        }
    </script>
</body>
</html>
