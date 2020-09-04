<?php
namespace Application\Contracts;

interface PaymentContract {
    public function setupWebHook();
    public function config();
}