<?php

class block_calculator extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_calculator');
    }

    public function get_content() {
        if ($this->content !== null) {
            return $this->content;
        }
        $this->content = new stdClass();
        $output = '';
        $result = '';
        if (optional_param('calc_submit', false, PARAM_BOOL)) {
            $num1 = optional_param('num1', 0, PARAM_FLOAT);
            $num2 = optional_param('num2', 0, PARAM_FLOAT);
            $op = optional_param('operation', '+', PARAM_ALPHA);
            switch ($op) {
                case '+': $result = $num1 + $num2; break;
                case '-': $result = $num1 - $num2; break;
                case '*': $result = $num1 * $num2; break;
                case '/': $result = $num2 != 0 ? $num1 / $num2 : get_string('divisionbyzero', 'block_calculator'); break;
                default: $result = get_string('invalidoperation', 'block_calculator');
            }
            $output .= '<div>' . get_string('result', 'block_calculator', $result) . '</div>';
        }
        $output .= '<form method="post">';
        $output .= '<input type="number" name="num1" step="any" required> ';
        $output .= '<select name="operation">';
        $output .= '<option value="+">+</option>';
        $output .= '<option value="-">-</option>';
        $output .= '<option value="*">*</option>';
        $output .= '<option value="/">/</option>';
        $output .= '</select> ';
        $output .= '<input type="number" name="num2" step="any" required> ';
        $output .= '<input type="submit" name="calc_submit" value="' . get_string('calculate', 'block_calculator') . '">';
        $output .= '</form>';
        $this->content->text = $output;
        $this->content->footer = '';
        return $this->content;
    }
}
