<?php

declare(strict_types=1);

namespace Rector\NetteCodeQuality\FormControlTypeResolver;

use PhpParser\Node;
use PhpParser\Node\Expr\MethodCall;
use Rector\NetteCodeQuality\Contract\FormControlTypeResolverInterface;
use Rector\NetteCodeQuality\Contract\MethodNamesByInputNamesResolverAwareInterface;
use Rector\NetteCodeQuality\NodeResolver\MethodNamesByInputNamesResolver;
use Rector\NodeCollector\NodeFinder\FunctionLikeParsedNodesFinder;
use Rector\NodeNameResolver\NodeNameResolver;

final class MethodCallFormControlTypeResolver implements FormControlTypeResolverInterface, MethodNamesByInputNamesResolverAwareInterface
{
    /**
     * @var NodeNameResolver
     */
    private $nodeNameResolver;

    /**
     * @var FunctionLikeParsedNodesFinder
     */
    private $functionLikeParsedNodesFinder;

    /**
     * @var MethodNamesByInputNamesResolver
     */
    private $methodNamesByInputNamesResolver;

    public function __construct(
        FunctionLikeParsedNodesFinder $functionLikeParsedNodesFinder,
        NodeNameResolver $nodeNameResolver
    ) {
        $this->nodeNameResolver = $nodeNameResolver;
        $this->functionLikeParsedNodesFinder = $functionLikeParsedNodesFinder;
    }

    /**
     * @return array<string, string>
     */
    public function resolve(Node $node): array
    {
        if (! $node instanceof MethodCall) {
            return [];
        }

        if ($this->nodeNameResolver->isName($node->name, 'getComponent')) {
            return [];
        }

        $classMethod = $this->functionLikeParsedNodesFinder->findClassMethodByMethodCall($node);
        if ($classMethod === null) {
            return [];
        }

        return $this->methodNamesByInputNamesResolver->resolveExpr($classMethod);
    }

    public function setResolver(MethodNamesByInputNamesResolver $methodNamesByInputNamesResolver): void
    {
        $this->methodNamesByInputNamesResolver = $methodNamesByInputNamesResolver;
    }
}
