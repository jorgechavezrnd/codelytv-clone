<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Courses\Application\Create;

use CodelyTv\Mooc\Courses\Domain\Course;
use CodelyTv\Mooc\Courses\Domain\CourseDuration;
use CodelyTv\Mooc\Courses\Domain\CourseName;
use CodelyTv\Mooc\Courses\Domain\CourseRepository;
use CodelyTv\Mooc\Shared\Domain\Courses\CourseId;

final class CourseCreator
{
    private CourseRepository $repository;

    public function __construct(CourseRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CourseId $id, CourseName $name, CourseDuration $duration): void
    {
        $course = Course::create($id, $name, $duration);

        $this->repository->save($course);
    }
}
