<?php

/* event.html */
class __TwigTemplate_a48bffd7f3c23d56b68858695baf543743cc9e327cc1249f5a1502d026ac260d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<li>
    <h3>New Title</h3>
    <h4>";
        // line 3
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "title", array()), "html", null, true);
        echo "</h4>
    <p>Start Date : ";
        // line 4
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["event"]) ? $context["event"] : null), "startDate", array()), "html", null, true);
        echo "</p>
</li>";
    }

    public function getTemplateName()
    {
        return "event.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  27 => 4,  23 => 3,  19 => 1,);
    }
}
/* <li>*/
/*     <h3>New Title</h3>*/
/*     <h4>{{ event.title }}</h4>*/
/*     <p>Start Date : {{ event.startDate }}</p>*/
/* </li>*/
