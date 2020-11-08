<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Courses\Domain;

use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;

final class Course
{
    private CourseId       $id;
    private CourseName     $name;
    private CourseDuration $duration;

    public function __construct(CourseId $id, CourseName $name, CourseDuration $duration)
    {
        $this->id       = $id;
        $this->name     = $name;
        $this->duration = $duration;
    }

    public static function create(CourseId $id, CourseName $name, CourseDuration $duration): self
    {
        $course = new self($id, $name, $duration);

        return $course;
    }

    public function id(): CourseId
    {
        return $this->id;
    }

    public function name(): CourseName
    {
        return $this->name;
    }

    public function duration(): CourseDuration
    {
        return $this->duration;
    }
}
