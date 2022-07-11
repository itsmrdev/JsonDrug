<?php
class CreateForm
{

    public function date($date)
    {
        $component = '';
        if (isset($date->type) && $date->type == 'date') {

            $isRequired = (isset($date->isRequired) && $date->isRequired) ? 'required' : '';
            $isReadonly = (isset($date->isReadonly) && $date->isReadonly) ? 'readonly' : '';
            $unit = (isset($date->unit) && $date->unit) ? '('.$date->unit.')' : '';
            $pattern = $date->type == 'date' ? 'pattern="\d{4}-\d{1,2}-\d{1,2}"' : '';

            $divStart = "<div class='form-input-div col-50'>";

            $label = "<label class='label'>" . $date->label .$unit "</label>";

            $input = "<input name='" . $date->key . "' class='input-form' type='" . $date->type . "' $isRequired $isReadonly $pattern></input>";

            $divEnd = "</div>";
            $component = $divStart . $label . $input . $divEnd;
        }
        return $component;
    }
    public function number($number)
    {
        $component = '';
        if (isset($number->type) && $number->type == 'number') {

            $isRequired = (isset($number->isRequired) && $number->isRequired) ? 'required' : '';
            $isReadonly = (isset($number->isReadonly) && $number->isReadonly) ? 'readonly' : '';
            $unit = (isset($number->unit) && $number->unit) ? '('.$number->unit.')' : '';

            $divStart = "<div class='form-input-div col-50'>";

            $label = "<label class='label'>" . $number->label .$unit "</label>";

            $input = "<input name='" . $number->key . "' class='input-form' type='" . $number->type . "' $isRequired $isReadonly></input>";

            $divEnd = "</div>";
            $component = $divStart . $label . $input . $divEnd;
        }
        return $component;
    }
    public function dropdown($dropdown)
    {
        $component = '';
        if (isset($dropdown->type) && $dropdown->type == 'dropdown') {
            $isRequired = (isset($dropdown->isRequired) && $dropdown->isRequired) ? 'required' : '';
            $isReadonly = (isset($dropdown->isReadonly) && $dropdown->isReadonly) ? 'readonly' : '';
            $unit = (isset($dropdown->unit) && $dropdown->unit) ? '('.$dropdown->unit.')' : '';
            $divStart = "<div class='form-input-div col-50'>";

            $label = "<label class='label'>" . $dropdown->label .$unit "</label>";

            $selectOpen = "<select name='" . $dropdown->key . "' class='input-form dropdown' $isRequired $isReadonly>";
            $options = '';
            if (isset($dropdown->items) && !empty($dropdown->items)) {
                foreach ($dropdown->items as $option) {
                    $options = $options . "<option value='" . $option->value . "'>" . $option->text . "</option>";
                }
            }
            $selectClose = "</select>";
            $divEnd = "</div>";
            $component = $divStart . $label . $selectOpen . $options . $selectClose . $divEnd;
        }
        return $component;
    }
}
