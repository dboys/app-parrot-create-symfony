<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

use Psr\Log\LoggerInterface;

use AppBundle\Parrot\Create\HLL;
use AppBundle\Parrot\Create\Library;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Method({"GET"})
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR
        ]);
    }

    /**
     * @Route("/")
     * @Method({"POST"})
     */
    public function downloadAction(Request $request, LoggerInterface $logger)
    {
        $file = null;
        $data = $request->request->all();

        if (isset($data['lib'])) {
            $lib_content = $this->render('project-templates/library.twig', array(
                    'Revision' => $data['lib_parrot_revision'],
                    'object'   => array(
                        'name'         => $data['lib_name'],
                        'build_system' => $data['lib_builder'],
                        'test_system'  => $data['lib_test']
                    )
                )
            )->getContent();

            $library = new Library(array('name' => $data['lib_name'], 'template_content' => $lib_content, 'logger' => $logger));
            $file = $library->generate();
        }
        else {
            $hll_content = $this->render('project-templates/hll.twig', array(
                    'Revision' => $data['hll_parrot_revision'],
                    'object'   => array(
                        'name'         => $data['hll_name'],
                        'build_system' => $data['hll_builder'],
                        'test_system'  => $data['hll_test'],
                        'with_pmc'     => $data['with_pmc'],
                        'with_ops'     => $data['with_ops'],
                        'with_doc'     => $data['with_doc']
                    )
                )
            )->getContent();

            $hll = new HLL(array('name' => $data['hll_name'], 'template_content' => $hll_content, 'logger' => $logger));
            $file = $hll->generate();
        }

        if (file_exists($file)) {
            $response = new BinaryFileResponse($file);
            $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT);

            return $response;
        }
        else {
            return $this->redirect('/');
        }
    }
}
