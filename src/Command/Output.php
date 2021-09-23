<?php


namespace Monkeyhh\Pdo\Command;

use Monkeyhh\Pdo\Command\Style;

class Output
{
    //3种格式
    const STYLE_NORMAL = 1;
    const STYLE_TITLE = 2;
    const STYLE_DESC = 3;

    private static $_instance = null;

    /** @var  Resource */
    private $file_handle = null;

    /** @var Style */
    private $_style = null;

    public function __construct()
    {
        $this->file_handle = fopen('php://output', 'w');
        if (!is_resource($this->file_handle)) {
            throw new \RuntimeException('Unable to open output.');
        }
        $this->_style = new Style('black');
    }


    /**
     * 获取实例
     * @return Command|null
     */
    public static function getInstance()
    {
        self::$_instance = empty(self::$_instance) ? new self() : self::$_instance;
        return self::$_instance;
    }

    /**
     * @param array $options
     */
    public function outOptions($options = [])
    {

        //标题
        $this->_style->setForeground('yellow');
        $message = $this->_style->apply($options['title']);
        $this->fwriteWrap($message);

        foreach ($options['content'] as $option) {

            foreach ($option as $key => $item) {
                if ($key == 0) {

                    $this->_style->setForeground('yellow');
                    $option[0] = sprintf('%-6s', $option[0]);

                    $message = $this->_style->apply($option[0] . "\t");
                    fwrite($this->file_handle, $message);

                } elseif ($key < count($option) - 1) {
                    $this->_style->setForeground('yellow');
                    $option[1] = sprintf('%-15s', $option[1]);
                    $message = $this->_style->apply($option[1] . "\t");
                    fwrite($this->file_handle, $message);
                } else {
                    $this->_style->setForeground('yellow');
                    $message = $this->_style->apply($option[count($option) - 1]);
                    $this->fwriteWrap($message);
                }
            }
        }

        $this->fwriteWrap("\n");

        return true;
    }

    /**
     * @param $message
     * @param string $before_cut
     * @param string $end_cut
     * @param string $style "yellow|black|red|green|..."
     * @return bool
     */
    public function outPut($message, $before_cut = "", $end_cut = "", $style = 'black')
    {

        $this->_style->setForeground($style);
        $message = sprintf("%s%s%s", $before_cut, $message, $end_cut);
        $message = $this->_style->apply($message);
        fwrite($this->file_handle, $message);
        $this->fwriteWrap();
        return true;
    }

    /**
     * @param $message
     * @param string $before_cut
     * @param string $end_cut
     * @param string $style
     * @return bool
     */
    public function outPutLine($message, $before_cut = "", $end_cut = "", $style = 'black')
    {
        $this->_style->setForeground($style);
        $message = sprintf("%s%s%s", $before_cut, $message, $end_cut);
        $message = $this->_style->apply($message);
        fwrite($this->file_handle, $message);
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