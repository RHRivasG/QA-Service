<?php namespace App\Interfaces;

interface QuestionServiceInterface
{
    public function showAccepted();
    public function showPending();
    public function showDenied();
}
