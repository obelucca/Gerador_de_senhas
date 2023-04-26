<?php

class Password {

    private $lenght;
    private $config;
    private $password;

    const SYMBOLS = '!@#$%^&*()_+-=';
    const NUMBERS = '0123456789';
    const LETTERS = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public function __construct($lenght = 8) {
        $this->password = '';
        $this->lenght = $lenght;
        $this->config = $this->getDefaultConfig();
    }

    public function setConfig($configKey, $value = false) {
        $this->config[$configKey]['config'] = $value;
    }

    public function generatePassword() {
        $charactersAlreadyChosen = 0;

        foreach ($this->config as $value) {
            if($value['config'] &&  $this->authorized()){
                $this->password .= $value['characters'][random_int(0, strlen($value['characters']) -1)];
                $charactersAlreadyChosen++;
            }
        }

        if($this->authorized()){
            $allCharacters = $this->getAllCharacters();
            for ($i = 0; $i < ($this->lenght - $charactersAlreadyChosen); $i++) {
                $this->password .= $allCharacters[random_int(0, strlen($allCharacters) - 1)];
            }
        }
    }

    public function getPassword() {
        return $this->password;
    }

    private function getDefaultConfig() {
        return [
            'use_uppercase' => [
                'config' => false,
                'characters' => self::LETTERS
            ],
            'use_lowercase' => [
                'config' => false,
                'characters' => strtolower(self::LETTERS)
            ],
            'use_numbers' => [
                'config' => false,
                'characters' => self::NUMBERS
            ],
            'use_symbols' => [
                'config' => false,
                'characters' => self::SYMBOLS
            ]
        ];
    }

    private function authorized() {
        return (strlen($this->password) < $this->lenght);
    }

    private function getAllCharacters() {
        return self::SYMBOLS . self::NUMBERS . self::LETTERS . strtolower(self::LETTERS);
    }

}