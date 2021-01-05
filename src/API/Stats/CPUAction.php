<?php
namespace Pagely\Interview\API\Stats;


use Pagely\ApiFramework\Action\NotFoundResponse;
use Pagely\ApiFramework\Action\ValidationResponse;
use Pagely\ApiFramework\Contract\ActionInputInterface;
use Pagely\Model\Accounts\Account;
use Pagely\Model\Analytics\Dimensions\CPU;
use Pagely\ApiFramework\Middleware\InvalidInputDefinitionException;

class CPUAction extends AbstractStatsAction
{
    use PoolGetterTrait;

    /**
     * @param ActionInputInterface|CPUInputDefinition $input
     * @return array|NotFoundResponse|ValidationResponse
     * @throws \Exception
     */
    protected function performAction(ActionInputInterface $input)
    {
        if (!($input instanceof CPUInputDefinition)) {
            throw new InvalidInputDefinitionException(get_class($input));
        }

        $pool = $this->poolFromAccount($input, self::POOL_P20_AND_NONEXISTENT);

        $names = $input->getServerNames();
        if (count($input->getServerIds()) === 0 && count($names) === 0 && count($input->getServerTypes()) === 0) {
            $filter = new CPU\CPU(['pool' => $pool]);
            $dimensions = $this->metrics->dimensions(
                $input->getFromDate(),
                $input->getToDate(),
                $filter);
            $names = $dimensions['dimensions']['name'];
        }

        $filter = new CPU\CPU([
            'pool' => $pool,
            'id' => $input->getServerIds(),
            'name' => $names,
            'type' => $input->getServerTypes(),
        ]);

        $validationResponse = $this->validateColumns($input, $filter);
        if ($validationResponse !== null) {
            return $validationResponse;
        }

        return $this->metrics->stats(
            $input->getFromDate(),
            $input->getToDate(),
            $input->getWindow(),
            $input->getSingleSeries(),
            $input->getColumns(),
            $filter
        );
    }
}
