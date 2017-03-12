<?php

/* webview/jobs/partials/job-item.twig */
class __TwigTemplate_1d35c34b4593619f1d74fc3bfba3eb26398b0891f3168a0947271fdf66abf902 extends Twig_Template
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
        $context["title"] = $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "hire_title", array());
        // line 2
        $context["username"] = (($this->getAttribute((isset($context["job"]) ? $context["job"] : null), "webuser_fname", array()) . " ") . $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "webuser_lname", array()));
        // line 3
        echo "                
<div class=\"row margintop-2 ms_white_box\">
    <div class=\"col-md-12 freelancer-job white-box\" style=\"padding: 20px\">
        <div class=\"row\">
            
            ";
        // line 8
        echo twig_include($this->env, $context, "webview/jobs/partials/job-user-info.twig");
        echo "
            
            ";
        // line 10
        echo twig_include($this->env, $context, "webview/jobs/partials/job-payment-info.twig");
        echo "
                
            <div class=\"col-md-4\">
                <div class=\"row\">
                    <div class=\"ms_hr_massage_butt\">
                        <div class=\"mystaff_msg_btnx hour_btn message_btn \">
                            <input type=\"button\" 
                                   class=\"btn btn-primary form-btn _job_btn_message\"
                                   data-bid=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "bid_id", array()), "html", null, true);
        echo "\"
                                   data-uid=\"";
        // line 19
        echo twig_escape_filter($this->env, (isset($context["chat_receiver_id"]) ? $context["chat_receiver_id"] : null), "html", null, true);
        echo "\"
                                   data-jid=\"";
        // line 20
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["job"]) ? $context["job"] : null), "job_id", array()), "html", null, true);
        echo "\"
                                   data-title=\"";
        // line 21
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo "\"
                                   data-uname=\"";
        // line 22
        echo twig_escape_filter($this->env, (isset($context["username"]) ? $context["username"] : null), "html", null, true);
        echo "\"
                                   value=\"";
        // line 23
        echo twig_escape_filter($this->env, app_lang("text_job_btn_message"), "html", null, true);
        echo "\">
                        </div>
                    </div>
                    
                    ";
        // line 27
        if (array_key_exists("specific_btn_template", $context)) {
            echo "    
                        ";
            // line 28
            echo twig_include($this->env, $context, (isset($context["specific_btn_template"]) ? $context["specific_btn_template"] : null));
            echo "
                    ";
        }
        // line 30
        echo "                    
                    ";
        // line 31
        if (array_key_exists("options_dropdown", $context)) {
            // line 32
            echo "                    <div class=\"ms_hr_drop_butt\">
                        <div class=\"dropdown hour_btnx dropdown_btn\">
                            <button class=\"btn btn-default dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">
                                <span class=\"caret\"></span>
                            </button>
                            <ul style=\"left: -156px;\" class=\"dropdown-menu\">
                                ";
            // line 38
            echo twig_include($this->env, $context, (isset($context["options_dropdown"]) ? $context["options_dropdown"] : null));
            echo "
                            </ul>
                        </div>
                    </div>
                    ";
        }
        // line 43
        echo "                </div>
            </div> 
        </div>
        <div class=\"row\">
            <div class=\"job_detais col-md-12\">
                ";
        // line 49
        echo "                ";
        if (array_key_exists("profil_link", $context)) {
            // line 50
            echo "                 <a href=\"";
            echo twig_escape_filter($this->env, (isset($context["profil_link"]) ? $context["profil_link"] : null), "html", null, true);
            echo "\" 
                    style=\"font-size: 14px;color: #3DB0DD;\">";
            // line 51
            echo twig_escape_filter($this->env, app_lang("text_job_btn_op_view_profile"), "html", null, true);
            echo "
                 </a>
                 <strong>-</strong>
                ";
        }
        // line 55
        echo "                
                ";
        // line 57
        echo "                ";
        if (array_key_exists("job_detail_link", $context)) {
            // line 58
            echo "                <a href=\"";
            echo twig_escape_filter($this->env, (isset($context["job_detail_link"]) ? $context["job_detail_link"] : null), "html", null, true);
            echo "\">  ";
            echo twig_escape_filter($this->env, app_lang("text_job_link_detail"), "html", null, true);
            echo " </a>  
                <strong>-</strong>
                ";
        }
        // line 61
        echo "                
                ";
        // line 63
        echo "                <span><b>";
        echo twig_escape_filter($this->env, character_limiter((isset($context["title"]) ? $context["title"] : null), 94, "..."), "html", null, true);
        echo "</b></span>
            </div>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "webview/jobs/partials/job-item.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  143 => 63,  140 => 61,  131 => 58,  128 => 57,  125 => 55,  118 => 51,  113 => 50,  110 => 49,  103 => 43,  95 => 38,  87 => 32,  85 => 31,  82 => 30,  77 => 28,  73 => 27,  66 => 23,  62 => 22,  58 => 21,  54 => 20,  50 => 19,  46 => 18,  35 => 10,  30 => 8,  23 => 3,  21 => 2,  19 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% set title            = job.hire_title %}
{% set username         = job.webuser_fname ~ ' ' ~ job.webuser_lname %}
                
<div class=\"row margintop-2 ms_white_box\">
    <div class=\"col-md-12 freelancer-job white-box\" style=\"padding: 20px\">
        <div class=\"row\">
            
            {{ include('webview/jobs/partials/job-user-info.twig') }}
            
            {{ include('webview/jobs/partials/job-payment-info.twig') }}
                
            <div class=\"col-md-4\">
                <div class=\"row\">
                    <div class=\"ms_hr_massage_butt\">
                        <div class=\"mystaff_msg_btnx hour_btn message_btn \">
                            <input type=\"button\" 
                                   class=\"btn btn-primary form-btn _job_btn_message\"
                                   data-bid=\"{{ job.bid_id }}\"
                                   data-uid=\"{{ chat_receiver_id }}\"
                                   data-jid=\"{{ job.job_id }}\"
                                   data-title=\"{{ title }}\"
                                   data-uname=\"{{ username }}\"
                                   value=\"{{ app_lang('text_job_btn_message') }}\">
                        </div>
                    </div>
                    
                    {% if specific_btn_template is defined %}    
                        {{ include( specific_btn_template ) }}
                    {% endif %}
                    
                    {% if options_dropdown is defined %}
                    <div class=\"ms_hr_drop_butt\">
                        <div class=\"dropdown hour_btnx dropdown_btn\">
                            <button class=\"btn btn-default dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">
                                <span class=\"caret\"></span>
                            </button>
                            <ul style=\"left: -156px;\" class=\"dropdown-menu\">
                                {{ include( options_dropdown ) }}
                            </ul>
                        </div>
                    </div>
                    {% endif %}
                </div>
            </div> 
        </div>
        <div class=\"row\">
            <div class=\"job_detais col-md-12\">
                {# profile link #}
                {% if profil_link is defined %}
                 <a href=\"{{ profil_link }}\" 
                    style=\"font-size: 14px;color: #3DB0DD;\">{{ app_lang('text_job_btn_op_view_profile') }}
                 </a>
                 <strong>-</strong>
                {% endif %}
                
                {# job detail link #}
                {% if job_detail_link is defined %}
                <a href=\"{{ job_detail_link }}\">  {{ app_lang('text_job_link_detail') }} </a>  
                <strong>-</strong>
                {% endif %}
                
                {# job hire title #}
                <span><b>{{ character_limiter(title, 94, '...') }}</b></span>
            </div>
        </div>
    </div>
</div>", "webview/jobs/partials/job-item.twig", "C:\\wamp\\www\\winjob\\application\\views\\webview\\jobs\\partials\\job-item.twig");
    }
}
