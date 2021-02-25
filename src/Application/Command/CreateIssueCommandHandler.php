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
    private Security $security;

    public function __construct(
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator,
        Security $security
    ) {
        $this->entityManager = $entityManager;
        $this->validator = $validator;
        $this->security = $security;
    }

    public function __invoke(CreateIssueCommand $command)
    {
        $user = $this->security->getUser();
        if (null === $user) {
            throw new \Exception("User not logged in");
        }

        $issue = new Issue();

        $issue->setTitle($command->getTitle());
        $issue->setContent($command->getContent());
        $issue->setCreatedBy($user);

        $errors = $this->validator->validate($issue);

        if (count($errors) > 0) {
            throw new ValidationException(iterator_to_array($errors));
        }

        $this->entityManager->persist($issue);
        $this->entityManager->flush();
    }
}
