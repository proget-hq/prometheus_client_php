<?php


namespace Prometheus;


use Prometheus\Storage\Adapter;

class Gauge extends Metric
{
    const TYPE = 'gauge';

    /**
     * @param double $value e.g. 123
     * @param array $labels e.g. ['status', 'opcode']
     */
    public function set($value, $labels = array())
    {
        $this->assertLabelsAreDefinedCorrectly($labels);

        $this->storageAdapter->storeSample(
            Adapter::COMMAND_SET,
            $this,
            new Sample(
                array(
                    'name' => $this->getName(),
                    'labelNames' => $this->getLabelNames(),
                    'labelValues' => $labels,
                    'value' => $value
                )
            )
        );
    }

    /**
     * @return string
     */
    public function getType()
    {
        return self::TYPE;
    }

    public function inc($labels = array())
    {
        $this->assertLabelsAreDefinedCorrectly($labels);

        $this->storageAdapter->storeSample(
            Adapter::COMMAND_INCREMENT_FLOAT,
            $this,
            new Sample(
                array(
                    'name' => $this->getName(),
                    'labelNames' => $this->getLabelNames(),
                    'labelValues' => $labels,
                    'value' => 1
                )
            )
        );
    }

    public function incBy($value, $labels = array())
    {
        $this->assertLabelsAreDefinedCorrectly($labels);

        $this->storageAdapter->storeSample(
            Adapter::COMMAND_INCREMENT_FLOAT,
            $this,
            new Sample(
                array(
                    'name' => $this->getName(),
                    'labelNames' => $this->getLabelNames(),
                    'labelValues' => $labels,
                    'value' => $value
                )
            )
        );
    }

    public function dec($labels = array())
    {
        $this->assertLabelsAreDefinedCorrectly($labels);

        $this->storageAdapter->storeSample(
            Adapter::COMMAND_INCREMENT_FLOAT,
            $this,
            new Sample(
                array(
                    'name' => $this->getName(),
                    'labelNames' => $this->getLabelNames(),
                    'labelValues' => $labels,
                    'value' => -1
                )
            )
        );
    }

    public function decBy($value, $labels = array())
    {
        $this->assertLabelsAreDefinedCorrectly($labels);

        $this->storageAdapter->storeSample(
            Adapter::COMMAND_INCREMENT_FLOAT,
            $this,
            new Sample(
                array(
                    'name' => $this->getName(),
                    'labelNames' => $this->getLabelNames(),
                    'labelValues' => $labels,
                    'value' => -$value
                )
            )
        );
    }
}
