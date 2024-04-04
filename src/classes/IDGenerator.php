<?php
class IDGenerator{
    private $length;
    private $include_numbers;
    
    public function __construct(int $length = 3, bool $include_numbers = true)
    {
        $this->length = $length;
        $this->include_numbers = $include_numbers;
    }
    
    public function get_length(): int
    {
        return $this->length;
    }
    
    public function set_length(int $length): void
    {
        $this->length = $length;
    }
    
    public function get_include_numbers(): bool
    {
        return $this->include_numbers;
    }
    
    public function set_include_numbers(bool $include_numbers): void
    {
        $this->include_numbers = $include_numbers;
    }

    public function generate_ID(): string
    {
        $result = "";
        // If allowed, use numbers in generation
        $selection = $this->include_numbers ? array_merge(range(97, 122), range(48, 57)) : range(97, 122);
        for ($i = 0; $i < $this->length; $i++){
            $result = $result . chr($selection[array_rand($selection)]);
        }

        return $result;
    }
}