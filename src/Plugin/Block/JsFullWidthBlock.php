<?php

namespace Drupal\js_fullwidth\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "js_fullwidth_block",
 *   admin_label = @Translation("js fullwidth block"),
 *   category = @Translation("js fullwidth block"),
 * )
 */
class JsFullWidthBlock extends BlockBase implements BlockPluginInterface
{
    public function build()
    {
        $config = $this->getConfiguration();

        if (!empty($config['HeaderText'])) {
            $header_text = $config['HeaderText'];
        } else {
            $header_text = $this->t('');
        }

        if (!empty($config['HeaderBgColor'])) {
            $bg_color = $config['HeaderBgColor'];
        } else {
            $bg_color = $this->t('');
        }

        if (!empty($config['HeaderTextColor'])) {
            $text_color = $config['HeaderTextColor'];
        } else {
            $text_color = $this->t('');
        }

        //Render template with variables
        return array(
            '#theme' => 'js-fullwidth-block',
            '#HeaderText' => $header_text,
            '#HeaderBgColor' => $bg_color,
            '#HeaderTextColor' => $text_color,

        );
    }

    public function blockForm($form, FormStateInterface $form_state)
    {
        $config = $this->getConfiguration();
        //New form
        $form = parent::blockForm($form, $form_state);
        $form['colorpicker']['#attached']['library'][] = 'js_fullwidth/colorpicker';


        $form['js_fullwidth_text'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Header Text'),
            '#default_value' => isset($config['HeaderText']) ? $config['HeaderText'] : '',
        );

        $form['js_fullwidth_bg_color'] = array(
            '#type' => 'color',
            '#title' => $this->t('Background color'),
            '#default_value' => isset($config['HeaderBgColor']) ? $config['HeaderBgColor'] : '',
            '#attributes' => array(
                'class' => array(
                    'form-control'
                )
            ),
        );

        $form['js_fullwidth_text_color'] = array(
            '#type' => 'color',
            '#title' => $this->t('Text color'),
            '#default_value' => isset($config['HeaderTextColor']) ? $config['HeaderTextColor'] : '',
            '#attributes' => array(
                'class' => array(
                    'form-control'
                )
            ),
        );


        return $form;

    }

    public function blockSubmit($form, FormStateInterface $form_state)
    {
        $this->configuration['HeaderText'] = $form_state->getValue('js_fullwidth_text');
        $this->configuration['HeaderBgColor'] = $form_state->getValue('js_fullwidth_bg_color');
        $this->configuration['HeaderTextColor'] = $form_state->getValue('js_fullwidth_text_color');
    }

    public function defaultConfiguration()
    {
        $default_config = \Drupal::config('js_fullwidth_header_text.settings');

        return array(
            'HeaderText' => $default_config->get('fullwidth.text'),
            'HeaderBgColor' => $default_config->get('fullwidth.bgcolor'),
            'HeaderTextColor' => $default_config->get('fullwidth.textcolor')
        );
    }
}