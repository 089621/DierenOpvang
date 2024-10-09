<?php

/**
 * PHPMailer - PHP email transport unit tests.
 * PHP version 5.5.
 *
 * @author    Marcus Bointon <phpmailer@synchromedia.co.uk>
 * @author    Andy Prevost
 * @copyright 2012 - 2020 Marcus Bointon
 * @copyright 2004 - 2009 Andy Prevost
 * @license   http://www.gnu.org/copyleft/lesser.html GNU Lesser General Public License
 */

namespace PHPMailer\Test\PHPMailer;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\Test\TestCase;

/**
 * Test HTML to text conversion functionality.
 *
 * @covers \PHPMailer\PHPMailer\PHPMailer::html2text
 */
final class Html2TextTest extends TestCase
{
    /**
     * Test converting an arbitrary HTML string into plain text.
     *
     * @dataProvider dataHtml2Text
     *
     * @param string $input    Arbitrary string, potentially containing HTML.
     * @param string $expected The expected function return value.
     * @param string $charset  Optional. Charset to use.
     */
    public function testHtml2Text($input, $expected, $charset = null)
    {
        if (isset($charset)) {
            $this->Mail->CharSet = $charset;
        }

        $result = $this->Mail->html2text($input);
        self::assertSame($expected, $result);
    }

    /**
     * Data provider.
     *
     * @return array
     */
    public function dataHtml2Text()
    {
        return [
            'Plain text, no encoded entities, surrounded by whitespace' => [
                'input'    => '  Lorem ipsum dolor sit amet, consectetur adipiscing elit.  ',
                'expected' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            ],
            'Plain text with encoded entities' => [
                'input'    => 'I&ntilde;t&euml;rn&acirc;ti&ocirc;n&agrave;liz&aelig;ti&oslash;n',
                'expected' => 'Iñtërnâtiônàlizætiøn',
                'charset'  => PHPMailer::CHARSET_UTF8
            ],

            'Simple HTML, including HTML comment and encoded quotes' => [
                'input'    => '<p>Test paragraph.</p>'
                    . '<!-- Comment -->'
                    . ' <a href="#fragment">Other text with &#39; and &quot;</a>',
                'expected' => 'Test paragraph. Other text with \' and "',
            ],
            'Simple HTML, including self-closing tags' => [
                'input'    => '<p>Test<br/>paragraph<br /><img src="file.png" alt="alt text" />.</p>',
                'expected' => 'Testparagraph.',
            ],
            'Simple HTML, paragraph fusing' => [
                'input'    => '<div>
<P style="color:blue;">color is blue</P><p>size is <span style="font-size:200%;">huge</span></p>
<p>material is wood</p>
</div>',
                'expected' => 'color is bluesize is huge
material is wood',
            ],
            'Full HTML message with head, title, body etc' => [
                'input'    => <<<EOT
<html>
    <head>
        <title>HTML email test</title>
    </head>
    <body>
        <h1>PHPMailer does HTML!</h1>
        <p>This is a <strong>test message</strong> written in HTML.<br>
        Go to <a href="http://code.google.com/a/apache-extras.org/p/phpmailer/">
        http://code.google.com/a/apache-extras.org/p/phpmailer/</a>
        for new versions of PHPMailer.</p>
        <p>Thank you!</p>
    </body>
</html>
EOT
                ,
                // Note: be careful when updating & saving this file. The the trailing space on
                // the line with "Go to " needs to be preserved!
                'expected' => <<<EOT
PHPMailer does HTML!
        This is a test message written in HTML.
        Go to 
        http://code.google.com/a/apache-extras.org/p/phpmailer/
        for new versions of PHPMailer.
        Thank you!
EOT
                ,
            ],
            // PHP bug: https://bugs.php.net/bug.php?id=78346
            'Plain text, with PHP short open echo tags' => [
                'input'    => '<?= \'<?= 1 ?>\' ?>2',
                'expected' => '2',
            ],
            'HTML with script tag' => [
                'input'    => 'lorem<script>alert("xss")</script>ipsum',
                'expected' => 'loremipsum',
            ],
            'HTML with style tag with content. uppercase HTML tags' => [
                'input'    => "lorem<STYLE>