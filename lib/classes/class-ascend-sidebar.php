<?php
/**
 * Determines whether or not to display the sidebar based on an array of conditional tags or page templates.
 */
class Ascend_Sidebar {
    private $conditionals;

    public $display = true;

    function __construct($conditionals = array()) {
        $this->conditionals = $conditionals;

        $conditionals = array_map(array($this, 'check_conditional_tag'), $this->conditionals);

        if (in_array(true, $conditionals)) {
            $this->display = false;
        }
    }

    private function check_conditional_tag($conditional_tag) {
        if (is_array($conditional_tag)) {
            return call_user_func_array($conditional_tag[0], $conditional_tag[1]);
        } else {
            return $conditional_tag();
        }
    }
}
