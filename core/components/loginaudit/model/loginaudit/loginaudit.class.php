<?php
/**
 * loginaudit
 *
 * Copyright 2014 by Mark Willis <mark.willis@adi.do>
 *
 * The base class for loginaudit.
 *
 * @package loginaudit
 */
class LoginAudit {
    /** @var \modX $modx */
    public $modx;

    /** @var array $config */
    public $config = array();

    /** @var array $chunks */
    public $chunks = array();

    /** @var object $form **/
    public $form;

    public function __construct(modX &$modx, array $config = array()) {
        $this->modx =& $modx;

        $corePath = $this->modx->getOption('loginaudit.core_path', $config, $this->modx->getOption('core_path') . 'components/loginaudit/');
        $assetsPath = $this->modx->getOption('loginaudit.assets_path', $config, $this->modx->getOption('assets_path') . 'components/loginaudit/');
        $assetsUrl = $this->modx->getOption('loginaudit.assets_url', $config, $this->modx->getOption('assets_url') . 'components/loginaudit/');
        $connectorUrl = $assetsUrl . 'connector.php';

        $this->config = array_merge(array(
            'assetsUrl' => $assetsUrl,
            'cssUrl' => $assetsUrl . 'css/',
            'jsUrl' => $assetsUrl . 'js/',
            'imagesUrl' => $assetsUrl . 'images/',
            'filePath' => $assetsPath . 'export/',

            'connectorUrl' => $connectorUrl,

            'corePath' => $corePath,
            'modelPath' => $corePath . 'model/',
            'chunksPath' => $corePath . 'elements/chunks/',
            'chunkSuffix' => '.chunk.tpl',
            'snippetsPath' => $corePath . 'elements/snippets/',
            'processorsPath' => $corePath . 'processors/',
            'templatesPath' => $corePath . 'templates/',
        ), $config);

        $this->modx->addPackage('loginaudit', $this->config['modelPath']);
        $this->modx->lexicon->load('loginaudit:default');
        $this->modx->lexicon->load('loginaudit:tv');
    }

    /**
     * Gets a Chunk and caches it; also falls back to file-based templates
     * for easier debugging.
     *
     * @access public
     * @param string $name The name of the Chunk
     * @param array $properties The properties for the Chunk
     * @return string The processed content of the Chunk
     */
    public function getChunk($name, array $properties = array()) {
        $chunk = null;
        if (!isset($this->chunks[$name])) {
            $chunk = $this->modx->getObject('modChunk', array('name' => $name));
            if (empty($chunk)) {
                $chunk = $this->_getTplChunk($name, $this->config['chunkSuffix']);
                if ($chunk == false) return false;
            }
            $this->chunks[$name] = $chunk->getContent();
        } else {
            $o = $this->chunks[$name];
            $chunk = $this->modx->newObject('modChunk');
            $chunk->setContent($o);
        }
        $chunk->setCacheable(false);
        return $chunk->process($properties);
    }
    /**
     * Returns a modChunk object from a template file.
     *
     * @access private
     * @param string $name The name of the Chunk. Will parse to name.chunk.tpl by default.
     * @param string $suffix The suffix to add to the chunk filename.
     * @return modChunk/boolean Returns the modChunk object if found, otherwise
     * false.
     */
    private function _getTplChunk($name, $suffix = '.chunk.tpl') {
        $chunk = false;
        $f = $this->config['chunksPath'] . strtolower($name) . $suffix;
        if (file_exists($f)) {
            $o = file_get_contents($f);
            /** @var modChunk $chunk */
            $chunk = $this->modx->newObject('modChunk');
            $chunk->set('name', $name);
            $chunk->setContent($o);
        }
        return $chunk;
    }

    /**
     * Debugging code with a halt
     */
    public function dump() {
        $args = func_get_args();
        die(var_dump($args));
    }
}
