<?php namespace Anomaly\DocumentationModule\Section\Form;

use Anomaly\DocumentationModule\Section\Contract\SectionInterface;
use Anomaly\DocumentationModule\Type\Contract\TypeInterface;
use Anomaly\DocumentationModule\Version\Contract\VersionInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class SectionFormBuilder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\DocumentationModule\Section\Form
 */
class SectionFormBuilder extends FormBuilder
{

    /**
     * The type instance.
     *
     * @var TypeInterface
     */
    protected $type = null;

    /**
     * The parent section.
     *
     * @var SectionInterface
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
            throw new \Exception('The $version parameter is required when creating a section.');
        }

        if (!$this->getType() && !$this->getEntry()) {
            throw new \Exception('The $type parameter is required when creating a section.');
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
     * Get the parent section.
     *
     * @return null|SectionInterface
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set the parent section.
     *
     * @param SectionInterface $parent
     * @return $this
     */
    public function setParent(SectionInterface $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get the version section.
     *
     * @return null|VersionInterface
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set the version section.
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
