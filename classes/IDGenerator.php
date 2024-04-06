<?php
// wydaje mi się, że mozna ja zmienic pod sama klase dla obslugi rejestracji @AdamrePL

class IDGenerator {
    private $length;
    private $name;
    /**
     * @var array Contains digits 0-9, uppercase and lowercase english alphabet letters.
    */
    private $chars = array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9));
    private string $split_character = '#';
    
    public function __construct(int $length = 3, string $name)
    {
        $this->length = $length;
        $this->name = $name;
    }
    
    public function get_length(): int
    {
        return $this->length;
    }
    
    public function set_length(int $length): void
    {
        $this->length = $length;
    }

    public function get_name(): string
    {
        return $this->name;
    }
    
    public function set_name(string $name): void
    {
        $this->name = $name;
    }

    public function generate_uid(): string
    {
        return strtolower($this->name) . $this->split_character . array_rand($this->chars, $this->length);
    }
}
