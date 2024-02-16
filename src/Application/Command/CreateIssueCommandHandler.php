<?php

namespace App\Application\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use App\Domain\Entity\Issue;
use App\Domain\Exception\ValidationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class CreateIssueCommandHandler implements MessageHandlerInterface
{
    private EntityManagerInterface $entityManager;
    private ValidatorInterface $validator;

    public function __construct(
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator
    ) {
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    public function __invoke(CreateIssueCommand $command)
    {
        $issue = new Issue();

        $issue->setTitle($command->getTitle());
        $issue->setContent($command->getContent());
        $issue->setCreatedBy($command->getCreatedBy());

        $errors = $this->validator->validate($issue);

        if (count($errors) > 0) {
            throw new ValidationException(iterator_to_array($errors));
        }

        $this->entityManager->persist($issue);
        $this->entityManager->flush();
    }
}
