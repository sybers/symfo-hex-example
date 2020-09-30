<?php

namespace App\Infrastructure\Controller;

use App\Application\Command\CreateIssueCommand;
use App\Application\Command\DeleteIssueCommand;
use App\Application\Query\GetIssueByIDQuery;
use App\Application\Query\ListAllIssuesQuery;
use App\Domain\Exception\EntityNotFoundException;
use App\Domain\Exception\ValidationException;
use App\Infrastructure\Form\Type\CreateIssueFormType;
use App\Infrastructure\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/issues", name="app_issue_")
 */
class IssueController extends AbstractController
{
    protected QueryBus $queryBus;

    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    /**
     * @Route("", name="index", methods={"GET", "POST"})
     */
    public function index(Request $request): Response
    {
        $form = $this->createForm(CreateIssueFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $issue = $form->getData();

            try {
                $this->queryBus->query(new CreateIssueCommand($issue['title'], $issue['content']));

                $this->addFlash('success', 'Issue created');

                return $this->redirectToRoute('app_issue_index');
            } catch (ValidationException $exception) {
                return new Response('Validation failed', 400);
            }
        }

        $order = $request->query->get('orderBy', 'title');
        $issues = $this->queryBus->query(new ListAllIssuesQuery($order));

        $deleteForms = [];
        foreach ($issues as $issue) {
            $builder = $this->createFormBuilder();
            $builder
                ->setAction($this->generateUrl('app_issue_delete', ['id' => $issue->getID()]))
                ->setMethod('DELETE')
                ->add('submit', SubmitType::class, ['label' => 'x']);

            $deleteForms[] = $builder->getForm()->createView();
        }

        return $this->render('issues/index.html.twig', [
            'issues' => $issues,
            'deleteForms' => $deleteForms,
            'createIssueForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(int $id): Response
    {
        try {
            $issue = $this->queryBus->query(new GetIssueByIDQuery($id));

            return $this->render('issues/show.html.twig', [
                'issue' => $issue
            ]);
        } catch (EntityNotFoundException $exception) {
            return new Response('Issue not found', 404);
        }
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(int $id): Response
    {
        try {
            $this->queryBus->query(new DeleteIssueCommand($id));

            $this->addFlash("success", "Issue deleted");

            return $this->redirectToRoute('app_issue_index');
        } catch (EntityNotFoundException $exception) {
            return new Response('Issue not found', 404);
        }
    }
}
