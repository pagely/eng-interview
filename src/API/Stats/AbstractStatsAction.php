<?php
namespace Pagely\Interview\API\Stats;


use Pagely\ApiFramework\Action\AccountPermissionAwareApiAction;
use Pagely\ApiFramework\ApiResponder;
use Pagely\ApiFramework\Contract\ActionInputInterface;
use Pagely\ApiFramework\Entity\ApiMetadata;
use Pagely\ApiFramework\Middleware\InvalidInputDefinitionException;
use Pagely\ApiFramework\Validation\ValidationBuilder;
use Pagely\Client\AccountsApi\AccountsApi;
use Pagely\Collaborator\CollaboratorAccessLoaderInterface;
use Pagely\Collaborator\Enumeration\AccountActions;
use Pagely\Metabolize\Hydrator\RecordHydrator;
use Pagely\Model\Accounts\Account;
use Pagely\Analytics\Service\Metrics;
use Pagely\ApiFramework\Action\ValidationResponse;
use Pagely\Model\Analytics\Dimensions\Dimensions;
use Pagely\ApiFramework\InputDefinition\AccountPermissionInputInterface;

abstract class AbstractStatsAction extends AccountPermissionAwareApiAction
{
    const POOL_P20_AND_NONEXISTENT = ['', '20'];

    /**
     * @var Metrics
     */
    protected $metrics;
    /**
     * @var AccountsApi
     */
    protected $accountsApi;
    /**
     * @var RecordHydrator
     */
    protected $hydrator;

    public function __construct(
        ApiResponder $responder,
        ApiMetadata $metadata,
        ValidationBuilder $validationBuilder,
        CollaboratorAccessLoaderInterface $accessLoader,
        AccountsApi $accountsApi,
        Metrics $metrics,
        RecordHydrator $hydrator
    ) {
        parent::__construct($responder, $metadata, $validationBuilder, $accessLoader);
        $this->accountsApi =  $accountsApi;
        $this->hydrator = $hydrator;
        $this->metrics = $metrics;
    }

    protected function getRequiredAction(): AccountActions
    {
        return AccountActions::APP_ACCESS();
    }

    protected function validateColumns(ColumnsProvider $input, Dimensions $filter): ?ValidationResponse
    {
        $invalidCols = $this->metrics->invalidColumns($input->getColumns(), $filter);
        if (count($invalidCols) > 0) {
            return new ValidationResponse([
                'body' => [
                    'columns' => [
                        "messages" => ["Non-existant column selected: ".implode(',',$invalidCols)]
                    ]
                ]
            ]);
        }
        return null;
    }

}
