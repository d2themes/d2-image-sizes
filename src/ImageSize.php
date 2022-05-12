<?php

namespace D2\Theme;

class ImageSize extends Component
{
    const ADD = 'add';
    const REMOVE = 'remove';
    const WIDTH = 'width';
    const HEIGHT = 'height';
    const CROP = 'crop';

    public function init()
    {
        if (array_key_exists(self::REMOVE, $this->config)) {
            /**
             * @link https://developer.wordpress.org/reference/functions/remove_image_size/
             */
            array_map('remove_image_size', $this->config[self::REMOVE]);
        }

        if (array_key_exists(self::ADD, $this->config)) {
            $this->add_image_sizes($this->config[self::ADD]);
        }
    }

    public function add_image_sizes(array $image_sizes)
    {
        foreach ($image_sizes as $name => $args) {
            /**
             * @link https://developer.wordpress.org/reference/functions/add_image_size/
             */
            $crop = (array_key_exists(self::CROP, $args) ? $args[self::CROP] : false);
            add_image_size($name, $args[self::WIDTH], $args[self::HEIGHT], $crop);
        }
    }
}
