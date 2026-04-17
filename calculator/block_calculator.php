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
        $this->content->text = $this->calculator_html();
        $this->content->footer = '';
        return $this->content;
    }

    private function calculator_html() {
        $id = uniqid('moodlecalc_');
        return '<div id="' . $id . '" class="moodle-calculator-block" style="max-width:220px;padding:8px;background:#f9f9f9;border-radius:8px;box-shadow:0 1px 3px #ccc;">
    <input type="text" class="moodle-calc-display" style="width:100%;font-size:1.5em;text-align:right;margin-bottom:8px;padding:4px;" readonly />
    <div class="moodle-calc-buttons" style="display:grid;grid-template-columns:repeat(4,1fr);gap:4px;">
        <button type="button">7</button><button type="button">8</button><button type="button">9</button><button type="button">/</button>
        <button type="button">4</button><button type="button">5</button><button type="button">6</button><button type="button">*</button>
        <button type="button">1</button><button type="button">2</button><button type="button">3</button><button type="button">-</button>
        <button type="button">0</button><button type="button">.</button><button type="button">=</button><button type="button">+</button>
        <button type="button" style="grid-column:span 4;background:#eee;" class="moodle-calc-clear">C</button>
    </div>
</div>
<script>
(function(){
    var root = document.getElementById("' . $id . '");
    var display = root.querySelector(".moodle-calc-display");
    var buttons = root.querySelectorAll("button");
    var current = "";
    var reset = false;
    buttons.forEach(function(btn){
        btn.addEventListener("click", function(){
            var v = btn.textContent;
            if(v === "C") {
                current = "";
                display.value = "";
            } else if(v === "=") {
                try {
                    current = eval(current).toString();
                } catch(e) {
                    current = "Error";
                }
                display.value = current;
                reset = true;
            } else {
                if(reset) { current = ""; reset = false; }
                current += v;
                display.value = current;
            }
        });
    });
})();
</script>';
    }
}
