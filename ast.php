<?php
include_once('astfun.php');

$json1 = '{"fields":[{"label":"Date of Birth (YYYY-MM-DD)","key":"birthday","isRequired":true,"order":1,"isReadonly":false,"type":"date"},{"label":"Gestational Age","key":"gestationalAge","isRequired":true,"order":3,"unit":"weeks","isReadonly":false,"type":"number"},{"label":"Sex","items":[{"value":"male","text":"Male"},{"value":"female","text":"Female"}],"key":"sex","isRequired":true,"order":4,"isReadonly":false,"type":"dropdown"},{"label":"Height","key":"height","isRequired":true,"order":5,"unit":"cm","isReadonly":false,"type":"number"},{"label":"Weight","key":"weight","isRequired":true,"order":6,"unit":"kg","isReadonly":false,"type":"number"},{"label":"BMI","key":"bmi","order":11,"unit":"kg/m²","isReadonly":true,"type":"number"}]}';
$json2 = '{"fields":[{"label":"Date of Birth (YYYY-MM-DD)","key":"birthday","isRequired":true,"order":1,"isReadonly":false,"type":"date"},{"label":"Sex","items":[{"value":"male","text":"Male"},{"value":"female","text":"Female"}],"key":"sex","isRequired":true,"order":2,"isReadonly":false,"type":"dropdown"},{"label":"Weight","key":"weight","isRequired":true,"order":3,"unit":"kg","isReadonly":false,"type":"number"}]}';

$CreateForm = new CreateForm();
$component = '';
$allowedInputTypes = array('number','date','dropdown');
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST['drugJson']) && !empty($_POST['drugJson'])) {
    $drugJson = $_POST['drugJson'];
  } else {
    echo "Please enter drug json data";
    die;
    // $drugJson = $json1; //default
  }
  // print_r($CreateForm->input());
  $drugArray = json_decode($drugJson);
  if (!isset($drugArray->fields) || empty($drugArray->fields)) {
    echo "Please choose valid json";
    die;
  }
  array_multisort(array_column($drugArray->fields, 'order'), SORT_ASC, $drugArray->fields);

  if (!empty($drugArray->fields)) {

    foreach ($drugArray->fields as $val) {
      if(in_array($val->type, $allowedInputTypes)){
        $html = $CreateForm->{$val->type}($val);
        $component = $component . $html;
      }
      
    }
  }
}
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
  </style>
</header>

<body>
  <div class="mainDiv">

    <?php if (isset($component) && $component != '') { ?>
      <form method="post" action="astvalidate.php">
        <div class="formDiv">
          <?php echo $component; ?>
          <div class="form-input-div col-50">
            <input class="input-form" type="submit" style="background:green" name="submit">
          </div>

        </div>
      </form>
    <?php } else { ?>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="formDivDrug">

          <div class="form-input-div col-50">
            <label class="label">Drug json</label>
            <textarea class="input-form" name=" drugJson" required></textarea>
          </div>
          <div class="form-input-div col-50">
            <input class="input-form" type="submit" style="background:green" name="submit">
          </div>
        </div>
      </form>
    <?php } ?>


  </div>
</body>

</html>