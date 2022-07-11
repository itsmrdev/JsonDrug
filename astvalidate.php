<?php

$html = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        unset($_POST['submit']);
        if (!empty($_POST)) {
            $html = '<table>';
            $html = $html . '<tr class="head">';
            $html = $html . '<td>Input field</td>';
            $html = $html . '<td>Input value</td>';
            $html = $html . '</tr>';
            foreach ($_POST as $column => $value) {

                $html = $html . '<tr>';
                $html = $html . '<td>' . $column . '</td>';
                $html = $html . '<td>' . $value . '</td>';
                $html = $html . '</tr>';
            }
            $html = $html . '</table>';
        }
    }
}
$html_table = $html;
?>
<html>
<header>
    <style>
        .mainDiv {
            margin: auto;
            height: auto;
            width: 500px;
            padding: auto;
        }

        .head {
            background-color: grey;
            color: white;
        }

        .formDivDrug {
            padding: 10px;
        }

        .input-form {
            padding-bottom: 10px;
            padding-top: 10px;
            width: 100%;
        }

        .label {
            width: 100%;
            padding-bottom: 10px;
            padding-top: 10px;
        }

        .col-50 {
            width: 50%;
            float: left;
            padding: 10px;
        }

        table {
            border: 1px solid;
        }

        tr {
            border: 1px solid;
        }

        td {
            border: 1px solid;
        }
    </style>
</header>

<body>
    <div class="mainDiv">
        <?php if (isset($html_table) && $html_table != '') {
            echo $html_table;
        } ?>
    </div>
</body>

</html>