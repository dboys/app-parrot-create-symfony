<?php
    namespace Tests\AppBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
    use AppBundle\Parrot\Create\Library;

    const LIB_URI = '/lib_content';
    const LIB_REVISION = '5.3.0';

    class LibraryTest extends WebTestCase {
        public function testLibWinxedBuilderRosellaTest() {
            $client = static::createClient();

            $params = array(
                'lib_parrot_revision' => LIB_REVISION,
                'lib_name' => __FUNCTION__,
                'lib_builder' => 'Winxed',
                'lib_test' => 'Rosella (Winxed)'
            );
            $client->request('POST', LIB_URI, $params);
            $lib_content = $client->getResponse()->getContent();

            $lib = new Library(array('name' => $params['lib_name'], 'template_content' => $lib_content));
            $file = $lib->generate();
        }

        public function testLibPerl5BuilderPerl5Test() {
            $client = static::createClient();

            $params = array(
                'lib_parrot_revision' => LIB_REVISION,
                'lib_name' => __FUNCTION__,
                'lib_builder' => 'Perl 5',
                'lib_test' => 'Perl 5'
            );
            $client->request('POST', LIB_URI, $params);
            $lib_content = $client->getResponse()->getContent();

            $lib = new Library(array('name' => $params['lib_name'], 'template_content' => $lib_content));
            $file = $lib->generate();
        }

        public function testLibNQPBuilderNQPTest() {
            $client = static::createClient();

            $params = array(
                'lib_parrot_revision' => LIB_REVISION,
                'lib_name' => __FUNCTION__,
                'lib_builder' => 'NQP (Not Quite Perl 6)',
                'lib_test' => 'Rosella (NQP)'
            );
            $client->request('POST', LIB_URI, $params);
            $lib_content = $client->getResponse()->getContent();

            $lib = new Library(array('name' => $params['lib_name'], 'template_content' => $lib_content));
            $file = $lib->generate();
        }

        public function testLibPirBuilderNQPTest() {
            $client = static::createClient();

            $params = array(
                'lib_parrot_revision' => LIB_REVISION,
                'lib_name' => __FUNCTION__,
                'lib_builder' => 'PIR (Parrot Intermediate Representation)',
                'lib_test' => 'Rosella (NQP)'
            );
            $client->request('POST', LIB_URI, $params);
            $lib_content = $client->getResponse()->getContent();

            $lib = new Library(array('name' => $params['lib_name'], 'template_content' => $lib_content));
            $file = $lib->generate();
        }
    }
?>