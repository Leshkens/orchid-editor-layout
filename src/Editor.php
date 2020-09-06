<?php

declare(strict_types=1);

namespace Leshkens\OrchidEditorLayout;

use Exception;
use Leshkens\OrchidEditorLayout\Tool;
use Orchid\Screen\Layouts\Base;
use Orchid\Screen\Repository;

abstract class Editor extends Base
{
    /**
     * @var Repository|null
     */
    protected $query;

    /**
     * Key property for query.
     *
     * @var mixed
     */
    protected $target;

    /**
     * @param Repository $repository
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed|void
     * @throws Exception
     */
    public function build(Repository $repository)
    {
        if (!$this->checkPermission($this, $repository)) {
            return;
        }

        $this->query = $repository;

        return view('orchid-editor-layout::editor', [
            'target'       => $this->target,
            'inputName'    => $this->inputName(),
            'data'         => $repository->get($this->target),
            'tools'        => $this->toolsHandler(),
            'localization' => $this->localization(),
            'placeholder'  => $this->placeholder(),
            'autofocus'    => $this->autofocus(),
            'logLevel'     => $this->logLevel(),
            'minHeight'    => $this->minHeight()
        ]);
    }

    /**
     * @return string
     */
    public function placeholder(): string
    {
        return '';
    }

    /**
     * @return bool
     */
    public function autofocus(): bool
    {
        return false;
    }

    /**
     * @return string
     */
    public function logLevel(): string
    {
        return 'ERROR';
    }

    /**
     * @return int
     */
    public function minHeight(): int
    {
        return 300;
    }

    /**
     * @return string|null
     */
    protected function localization(): ?string
    {
        $trans = trans('orchid-editor-layout::editor');

        if ($trans !== 'orchid-editor-layout::editor') {
            return json_encode($trans, JSON_UNESCAPED_UNICODE);
        }
        return null;
    }

    /**
     * @return string
     */
    protected function toolsHandler(): string
    {
        $collection = collect($this->tools())->mapWithKeys(function (Tool $item) {
            return [$item->name => $item->serialize()];
        });
        return $collection->toJson();
    }

    /**
     * @return string|null
     */
    protected function inputName(): ?string
    {
        if (!is_null($this->target)) {
            $pieces = explode('.', $this->target);
            foreach ($pieces as $key => $piece) {
                $pieces[$key] = $key < 1 ? $piece : '['. $piece .']';
            }
            return implode('', $pieces);
        }
        return $this->target;
    }

    /**
     * @return array
     */
    abstract protected function tools(): array;
}
