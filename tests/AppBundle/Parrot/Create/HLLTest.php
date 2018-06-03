<?php
    namespace Tests\AppBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
    use AppBundle\Parrot\Create\HLL;

    const HLL_URI = '/hll_content';
    const HLL_REVISION = '5.3.0';

    class HLLTest extends WebTestCase {
        public function testHLLWinxedBuilderRosellaTestWithOptions() {
            $client = static::createClient();

            $params = array(
                'hll_parrot_revision' => HLL_REVISION,
                'hll_name' => __FUNCTION__,
                'hll_builder' => 'Winxed',
                'hll_test' => 'Rosella (Winxed)',
                'with_pmc' => 1,
                'with_ops' => 1,
                'with_doc' => 1
            );
            $client->request('POST', HLL_URI, $params);
            $hll_content = $client->getResponse()->getContent();

            $hll = new HLL(array('name' => $params['hll_name'], 'template_content' => $hll_content));
            $file = $hll->generate();
        }

        public function testHLLWinxedBuilderRosellaTestWithOutOptions() {
            $client = static::createClient();

            $params = array(
                'hll_parrot_revision' => HLL_REVISION,
                'hll_name' => __FUNCTION__,
                'hll_builder' => 'Winxed',
                'hll_test' => 'Rosella (Winxed)',
                'with_pmc' => 0,
                'with_ops' => 0,
                'with_doc' => 0
            );
            $client->request('POST', HLL_URI, $params);
            $hll_content = $client->getResponse()->getContent();

            $hll = new HLL(array('name' => $params['hll_name'], 'template_content' => $hll_content));
            $file = $hll->generate();
        }

        public function testHLLNQPBuilderNQPTestWithOptions() {
            $client = static::createClient();

            $params = array(
                'hll_parrot_revision' => HLL_REVISION,
                'hll_name' => __FUNCTION__,
                'hll_builder' => 'NQP (Not Quite Perl 6)',
                'hll_test' => 'Rosella (NQP)',
                'with_pmc' => 1,
                'with_ops' => 1,
                'with_doc' => 1
            );
            $client->request('POST', HLL_URI, $params);
            $hll_content = $client->getResponse()->getContent();

            $hll = new HLL(array('name' => $params['hll_name'], 'template_content' => $hll_content));
            $file = $hll->generate();
        }

        public function testHLLNQPBuilderNQPTestWithOutOptions() {
            $client = static::createClient();

            $params = array(
                'hll_parrot_revision' => HLL_REVISION,
                'hll_name' => __FUNCTION__,
                'hll_builder' => 'NQP (Not Quite Perl 6)',
                'hll_test' => 'Rosella (NQP)',
                'with_pmc' => 0,
                'with_ops' => 0,
                'with_doc' => 0
            );
            $client->request('POST', HLL_URI, $params);
            $hll_content = $client->getResponse()->getContent();

            $hll = new HLL(array('name' => $params['hll_name'], 'template_content' => $hll_content));
            $file = $hll->generate();
        }

        public function testHLLPirBuilderNQPTestWithOptions() {
            $client = static::createClient();

            $params = array(
                'hll_parrot_revision' => HLL_REVISION,
                'hll_name' => __FUNCTION__,
                'hll_builder' => 'PIR (Parrot Intermediate Representation)',
                'hll_test' => 'Rosella (NQP)',
                'with_pmc' => 1,
                'with_ops' => 1,
                'with_doc' => 1
            );
            $client->request('POST', HLL_URI, $params);
            $hll_content = $client->getResponse()->getContent();

            $hll = new HLL(array('name' => $params['hll_name'], 'template_content' => $hll_content));
            $file = $hll->generate();
        }

        public function testHLLPirBuilderNQPTestWithOutOptions() {
            $client = static::createClient();

            $params = array(
                'hll_parrot_revision' => HLL_REVISION,
                'hll_name' => __FUNCTION__,
                'hll_builder' => 'PIR (Parrot Intermediate Representation)',
                'hll_test' => 'Rosella (NQP)',
                'with_pmc' => 0,
                'with_ops' => 0,
                'with_doc' => 0
            );
            $client->request('POST', HLL_URI, $params);
            $hll_content = $client->getResponse()->getContent();

            $hll = new HLL(array('name' => $params['hll_name'], 'template_content' => $hll_content));
            $file = $hll->generate();
        }

        public function testHLLPerl5BuilderPerl5TestWithOptions() {
            $client = static::createClient();

            $params = array(
                'hll_parrot_revision' => HLL_REVISION,
                'hll_name' => __FUNCTION__,
                'hll_builder' => 'Perl 5',
                'hll_test' => 'Perl 5',
                'with_pmc' => 1,
                'with_ops' => 1,
                'with_doc' => 1
            );
            $client->request('POST', HLL_URI, $params);
            $hll_content = $client->getResponse()->getContent();

            $hll = new HLL(array('name' => $params['hll_name'], 'template_content' => $hll_content));
            $file = $hll->generate();
        }

        public function testHLLPerl5BuilderPerl5TestWithOutOptions() {
            $client = static::createClient();

            $params = array(
                'hll_parrot_revision' => HLL_REVISION,
                'hll_name' => __FUNCTION__,
                'hll_builder' => 'Perl 5',
                'hll_test' => 'Perl 5',
                'with_pmc' => 1,
                'with_ops' => 1,
                'with_doc' => 1
            );
            $client->request('POST', HLL_URI, $params);
            $hll_content = $client->getResponse()->getContent();

            $hll = new HLL(array('name' => $params['hll_name'], 'template_content' => $hll_content));
            $file = $hll->generate();
        }
    }
?>