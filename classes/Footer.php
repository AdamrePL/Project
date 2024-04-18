<?php
class Footer {
    private $content;
    public function __construct(string $content){
        $this->content = $content;
    }
    public function set_content(string $content) : void {
        $this->content = $content;
    }
    public function get_content() : string {
        return $this->content;
    }
    public function render_footer() : void {
        echo "$this->content";
    }
}