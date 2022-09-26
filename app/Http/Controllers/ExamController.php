<?php

namespace App\Http\Controllers;


use App\Http\Errors\ErrorHandler;
use App\Services\ExamService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ExamController
{
    protected ExamService $examService;

    public function __construct(ExamService $examService)
    {
        $this->examService = $examService;
    }

    public function store(Request $request): JsonResponse
    {
        try{
           $exam = $this->examService->create(
               $request->get('student_id'),
               $request->get('subject_id'),
               $request->get('question_quantity')
           );

            return response()->json([
                'message' => 'The exam ' .  $exam->getId() . ' are created successfully'
            ]);


        }catch (\Exception $e){
            ErrorHandler::handleException($e);
        }
    }
}