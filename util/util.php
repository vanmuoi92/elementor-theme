<?php
class CM_Util
{
    public static function generate_html_attrs($attrs = [])
    {
        if (count($attrs) <= 0 || !is_array($attrs)) {
            return '';
        }

        $after_format = [];
        foreach ($attrs as $key => $attr) {
            if (is_array($attr) && $key === 'style') {
                $items = [];
                foreach ($attr as $k => $v) {
                    if (!empty($v)) {
                        $items[] = sprintf('%s:%s', $k, $v);
                    }
                }
                $after_format[] = sprintf('%s="%s"', $key, join(';', $items));
            } else if (is_array($attr) && $key === 'class') {
                $after_format[] = sprintf('%s="%s"', $key, join(' ', $attr));
            } else {
                $after_format[] = sprintf('%s="%s"', $key, $attr);
            }
        }

        return join(" ", $after_format);
    }

    public static function get_assets_url($path = '')
    {
        $asset_base_url = get_template_directory_uri() . '/assets/';
        return  $asset_base_url . $path;
    }
}
