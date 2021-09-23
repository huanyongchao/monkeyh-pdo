<?php


namespace Monkeyhh\Pdo\Command;

use Monkeyhh\Pdo\Command\Style;

class Output
{
    //3种格式
    const STYLE_NORMAL = 1;
    const STYLE_TITLE = 2;
    const STYLE_DESC = 3;

    /** @var  Resource */
    private $file_handle;

    public function __construct()
    {
        $this->file_handle = fopen('php://output', 'w');
        if (!is_resource($this->file_handle)) {
            throw new \RuntimeException('Unable to open output.');
        }
    }


    /**
     * @param array $options
     */
    public function outOptions($options = [])
    {

        //标题
        $style = new Style('yellow');
        $message = $style->apply($options['title']);
        $this->fwriteWrap($message);

        foreach ($options['content'] as $option) {

            foreach($option as $key=>$item) {
                if ($key == 0) {

                    $style = new Style('green');
                    $option[0] = sprintf('%-6s', $option[0]);

                    $message = $style->apply($option[0] . "\t");
                    fwrite($this->file_handle, $message);

                } elseif ($key < count($option) - 1) {
                    $style = new Style('green');
                    $option[1] = sprintf('%-15s', $option[1]);
                    $message = $style->apply($option[1] . "\t");
                    fwrite($this->file_handle, $message);
                } else {
                    $style = new Style('black');
                    $message = $style->apply($option[count($option) - 1]);
                    $this->fwriteWrap($message);
                }
            }
        }

        $this->fwriteWrap("\n");

        return true;
    }

    /**
     * @param $message
     * @param int $style
     */
    public function outPut($message, $style = 1)
    {

        return true;
    }

    /**
     * @param string $message
     */
    public function fwriteWrap($message = '')
    {
        $message = $message . "\n";
        fwrite($this->file_handle, $message);
    }
}