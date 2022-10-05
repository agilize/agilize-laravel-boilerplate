<?php

namespace Tests\Unit\Service;


use App\Models\Student;
use App\Repositorys\StudentRepository;
use App\Services\StudentService;
use PHPUnit\Framework\TestCase;

class StudentServiceTest extends TestCase
{
    public function testCreateFunctionShouldReturnAStudent()
    {
        // given
        $studentMock = $this->createMock(Student::class);

        $studentRepositoryMock = $this->createMock(StudentRepository::class);
        $studentRepositoryMock->method('create')->willReturn($studentMock);

        $studentService = new StudentService($studentRepositoryMock);

        // when
        $result = $studentService->create('Luiz Henrique');

        // then
        $this->assertInstanceOf(Student::class, $result);
    }

    public function testCreateFunctionShouldReturnAExceptionIfSubjectIsEmpty()
    {
        $this->expectException(\Exception::class);

        // given
        $studentRepositoryMock = $this->createMock(StudentRepository::class);

        $studentService = new StudentService($studentRepositoryMock);

        // when
        $studentService->create(null);
    }

    public function testCreateFunctionShouldReturnAExceptionIfSubjectIsLesserThanThreeCaracters()
    {
        $this->expectException(\Exception::class);

        // given
        $studentRepositoryMock = $this->createMock(StudentRepository::class);

        $studentService = new StudentService($studentRepositoryMock);

        // when
        $studentService->create('an');
    }
}