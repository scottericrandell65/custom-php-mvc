<?php

class Validator
{
	private array $data;
	private array $errors = [];
	
	public function __construct(array $data)
	{
		$this->data = $data;
	}
	
	public function required(array $fields): self
	{
		foreach ($fields as $field) {
			
			$value = trim($this->data[$field] ?? '');
			
			if ($value === '') {
				$this->errors[$field] = ucfirst($field) . ' is required.';
			}
		}
		
		return $this;
	}
	
	public function min(string $field, int $length): self
	{
		if (isset($this->errors[$field])) {
			return $this;
		}
		
		$value = trim($this->data[$field] ?? '');
		
		if (strlen($value) < $length) {
			$this->errors[$field] =
				ucfirst($field) . " must be at least {$length} characters.";
		}
		
		return $this;
	}
	
	public function email(string $field): self
	{
		// Dont overwrite an existing error
		if (isset($this->errors[$field])) {
			return $this;
		}
		
		$value = trim($this->data[$field] ?? '');
		
		if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
			$this->errors[$field] = 'Invalid email address.';
		}
		
		return $this;
	}
	
	public function fails(): bool
	{
		return !empty($this->errors);
	}
	
	public function passed(): bool
	{
		return empty($this->errors);
	}
	
	public function errors(): array
	{
		return $this->errors;
	}
	
	public function error(string $field): ?string
	{
		return $this->errors[$field] ?? null;
	}
}
