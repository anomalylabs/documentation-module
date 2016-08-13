<?php namespace Anomaly\DocumentationModule\Page\Form;

use Anomaly\DocumentationModule\Page\Contract\PageInterface;
use Anomaly\DocumentationModule\Type\Contract\TypeInterface;
use Anomaly\DocumentationModule\Version\Contract\VersionInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class PageFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Page\Form
 */
class PageFormBuilder extends FormBuilder
{

    /**
     * The type instance.
     *
     * @var TypeInterface
     */
    protected $type = null;

    /**
     * The parent page.
     *
     * @var PageInterface
     */
    protected $parent = null;

    /**
     * The version instance.
     *
     * @var VersionInterface
     */
    protected $version = null;

    /**
     * The skipped fields.
     *
     * @var array
     */
    protected $skips = [
        'entry',
        'parent',
        'path',
        'str_id',
        'type',
        'version',
    ];

    /**
     * Fired when the builder is ready to build.
     *
     * @throws \Exception
     */
    public function onReady()
    {
        if (!$this->getVersion() && !$this->getEntry()) {
            throw new \Exception('The $version parameter is required when creating a page.');
        }

        if (!$this->getType() && !$this->getEntry()) {
            throw new \Exception('The $type parameter is required when creating a page.');
        }
    }

    /**
     * Fired just before saving the entry.
     */
    public function onSaving()
    {
        $parent = $this->getParent();
        $entry  = $this->getFormEntry();

        if (!$entry->version_id && $version = $this->getVersion()) {
            $entry->version_id = $version->getId();
        }

        if (!$entry->type_id && $type = $this->getType()) {
            $entry->type_id = $type->getId();
        }

        if ($parent) {
            $entry->parent_id = $parent->getId();
        }
    }

    /**
     * Get the type.
     *
     * @return null|TypeInterface
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set the type.
     *
     * @param TypeInterface $type
     * @return $this
     */
    public function setType(TypeInterface $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the parent page.
     *
     * @return null|PageInterface
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set the parent page.
     *
     * @param PageInterface $parent
     * @return $this
     */
    public function setParent(PageInterface $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get the version page.
     *
     * @return null|VersionInterface
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set the version page.
     *
     * @param VersionInterface $version
     * @return $this
     */
    public function setVersion(VersionInterface $version)
    {
        $this->version = $version;

        return $this;
    }
}
